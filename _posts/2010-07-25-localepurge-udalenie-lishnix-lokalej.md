---
id: 992
title: localepurge удаление лишних локалей
date: 2010-07-25T20:59:31+00:00
author: vanoc
layout: post
guid: /?p=992
permalink: /ubuntu/localepurge-udalenie-lishnix-lokalej/
dsq_thread_id:
  - "164630856"
categories:
  - runix
  - ubuntu
tags:
  - localepurge
---
**localepurge** &#8212; программа очистки неиспользуемых локалей, т.е. переводов, манов, справок и прочее на различных языках. Большинство из них не нужны и хранить на компьютере не имеет смысла, особенно в условиях ограниченного объема.

Пакет есть в репозиториях, поэтому установка выглядит так
  
`sudo aptitude install localepurge`

Во время установки программа предложит выбрать необходимые локали.

[<img class="aligncenter size-medium wp-image-993" title="localepurge" src="/uploads/2010/07/localepurge-300x199.png" alt="" width="300" height="199" srcset="/uploads/2010/07/localepurge-300x199.png 300w, /uploads/2010/07/localepurge.png 658w" sizes="(max-width: 300px) 100vw, 300px" />](/uploads/2010/07/localepurge.png)
  
**Будьте осторожны с выбором локалей, иначе неправильный выбор может повлечь удаление всех файлов локалей, даже тех, которые вы используете. После этого восстановить их можно будет только переустановкой всех пакетов, их предоставляющих.** 

Дополнительно настроить можно выполнив
  
`sudo dpkg-reconfigure localepurge`

Все настройки хранятся в файле **/etc/locale.nopurge** Там же можно увидеть выбранные локали. У меня такие
  
`en<br />
en_US<br />
en_US.ISO-8859-15<br />
en_US.UTF-8<br />
ru<br />
ru_RU<br />
ru_RU.CP1251<br />
ru_RU.KOI8-R<br />
ru_RU.UTF-8`

Запустить программу можно выполнив
  
`~$ localepurge<br />
localepurge: Disk space freed in /usr/share/locale: 0 KiB<br />
localepurge: Disk space freed in /usr/share/man: 0 KiB<br />
localepurge: Disk space freed in /usr/share/gnome/help: 0 KiB<br />
localepurge: Disk space freed in /usr/share/omf: 0 KiB<br />
localepurge: Disk space freed in /usr/share/doc/kde/HTML: 0 KiB<br />
Total disk space freed by localepurge: 0 KiB`

однако этого можно не делать, т.к. программа автоматически будет выполняться при установке/удалении программ.

Я уже запускал localepurge, поэтому сейчас показывает 0 KiB. Ранее удалилось ~177 Мб.