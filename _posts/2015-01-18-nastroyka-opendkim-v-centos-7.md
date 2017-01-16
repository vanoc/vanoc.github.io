---
id: 1727
title: настройка openDKIM в centos 7
date: 2015-01-18T22:41:48+00:00
author: vanoc
layout: post
guid: /?p=1727
permalink: /centos/nastroyka-opendkim-v-centos-7/
categories:
  - centos
tags:
  - DKIM
  - Postfix
---
Установим opendkim
  
`yum install opendkim`

Нужно в /etc/opendkim.conf поправить Mode и раскомментировать строки
  
`Mode    sv<br />
KeyTable        /etc/opendkim/KeyTable<br />
SigningTable    refile:/etc/opendkim/SigningTable`

Создадим ключи
  
`mkdir /etc/opendkim/keys/example.com<br />
chmod 750 /etc/opendkim/keys/example.com<br />
opendkim-genkey -D /etc/opendkim/keys/example.com/ -d example.com<br />
chmod 640 /etc/opendkim/keys/example.com/*<br />
chown -R opendkim:opendkim /etc/opendkim/keys/*`

Допишем в /etc/opendkim/KeyTable

<pre>default._domainkey.example.com example.com:default:/etc/opendkim/keys/example.com/default.private</pre>

и в /etc/opendkim/SigningTable
  
`*@example.com default._domainkey.example.com`

Для подписи субдоменов нужно добавить в /etc/opendkim.conf параметр
  
`SubDomains      yes`

а в /etc/opendkim/SigningTable
  
`*@<strong>sub</strong>.example.com default._domainkey.example.com`

Перезапустим opendkim
  
`systemctl restart opendkim.service`

Осталось научить postfix работать с dkim и указать для домена TXT запись.

Добавляем в /etc/postfix/main.cf

`#DKIM<br />
milter_default_action = accept<br />
milter_protocol = 2<br />
smtpd_milters = inet:localhost:8891<br />
non_smtpd_milters = inet:localhost:8891`

затем
  
`postfix restart`

Добавляем TXT запись.
  
Берем содержимое файла /etc/opendkim/keys/example.com/default.txt

<pre>default._domainkey      IN      TXT     ( "v=DKIM1; k=rsa; "
          "p=.................." )  ; ----- DKIM key default for example.com</pre>

Для субдомена запись будет вида

<pre>default._domainkey.<strong>sub.example.com</strong>      IN      TXT     ( "v=DKIM1; k=rsa; "
          "p=.................." )  ; ----- DKIM key default for example.com</pre>

Проверяем
  
`dig txt default._domainkey.example.com`

Отправляем тестовое письмо и наслаждаемся результатом.
  
[<img src="/uploads/2015/01/opendkim.png" alt="opendkim" width="481" height="259" class="aligncenter size-full wp-image-1728" srcset="/uploads/2015/01/opendkim.png 481w, /uploads/2015/01/opendkim-300x162.png 300w" sizes="(max-width: 481px) 100vw, 481px" />](/uploads/2015/01/opendkim.png)