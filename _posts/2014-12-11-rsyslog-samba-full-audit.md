---
id: 1715
title: rsyslog, samba, full audit
date: 2014-12-11T17:09:05+00:00
author: vanoc
layout: post
guid: /?p=1715
permalink: /centos/rsyslog-samba-full-audit/
categories:
  - centos
tags:
  - rsyslog
  - samba
---
После настройки самбы и дополнительного full.audit следует озаботиться тем, куда собственно этот аудит будет записываться.

Как рабочий пример:

<pre># less /etc/samba/smb.full_audit.conf
         full_audit:priority = NOTICE
         full_audit:facility = LOCAL5
         full_audit:success = mkdir rmdir read write rename unlink chmod fchmod 
chown fchown ftruncate lock symlink readlink link mknod close open
         full_audit:failure = none
         full_audit:prefix = |[%S]|%u|%I</pre>

Тут важна строка full_audit:facility = LOCAL5

Настраиваем /etc/rsyslog.conf
  
Находим строку
  
`*.info;mail.none;authpriv.none;cron.none                /var/log/messages`
  
и добавляем local5.none дабы в /var/log/messages не заносился аудит самбы
  
`*.info;mail.none;authpriv.none;cron.none;local5.none                /var/log/messages`
  
Указываем куда записывать аудит
  
`local5.*                                                /var/log/samba/samba.audit`

Дабы применились изменения перезапускаем rsyslog
  
`service rsyslog restart`

Однако в /var/log/messages скорее всего появится очень большое количество таких строк
  
`rsyslogd-2177: imuxsock begins to drop messages from pid 194326 due to rate-limiting<br />
rsyslogd-2177: imuxsock lost 684 messages from pid 194326 due to rate-limiting`

Это связано с тем, что <a href="http://www.rsyslog.com/doc/master/configuration/modules/imuxsock.html" target="_blank">rsyslog</a> по умолчанию для одного пида записывает в логи не более 200 записей в течении 5 секунд. Т.е. если пользователь заходит в самба шару с большим количеством файлов, то записей в samba.audit может быть больше 200, т.о. появляется запись в /var/log/messages о том, что rsyslog отбросил остальные строки.

Есть три варианта решения (по крайней мере я столько нашел)

1. Отключить ограничение. Добавляем в /etc/rsyslog.conf
  
`$SysSock.RateLimit.Interval 0`

2. Поиграться с интервалом и разрешенным чилом записей
  
например:
  
`$SysSock.RateLimit.Interval 10<br />
$SysSock.RateLimit.Burst 500`

3. Убрать записи &#171;imuxsock begins to drop messages бла бла бла&#187; из /var/log/messages
  
Решается добавлением в /etc/rsyslog.conf после #### RULES ####

`:msg, regex, "imuxsock begins to drop messages from pid .* due to rate-limiting" ~<br />
:msg, regex, "imuxsock lost .* messages from pid .* due to rate-limiting" ~`

Подробнее <a href="http://www.rsyslog.com/doc/master/configuration/filters.html" target="_blank">здесь</a>

Дабы применились изменения перезапускаем rsyslog
  
`service rsyslog restart`