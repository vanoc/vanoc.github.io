---
id: 1573
title: MTP на примере Acer CloudMobile S500
date: 2014-02-01T22:51:33+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1573
permalink: /arch/mtp-na-primere-acer-cloudmobile-s500/
categories:
  - arch
tags:
  - MTP
---
Потребовалось получить доступ к флешке подключенной в телефон Acer CloudMobile S500. Краткая выдержка <a href="https://wiki.archlinux.org/index.php/MTP" target="_blank">арч вики</a> с некоторыми комментариями.

Подключаем телефон к компу. В консоли смотрим результат вывода lsusb

`% lsusb<br />
...<br />
Bus 001 Device 004: ID <strong>0502</strong>:<strong>33aa</strong> Acer, Inc.<br />
...`
  
Вот и телефон.

Копируем или правим прям там же файл.
  
`% sudo cp /usr/lib/udev/rules.d/69-libmtp.rules /etc/udev/rules.d/<br />
% sudo vim /etc/udev/rules.d/69-libmtp.rules`
  
Находим строки, в которых упоминается Acer, дублируем одну из них. Изменяем значения idVendor и idProduct на значения нашего аппарата.
  
`# Acer CloudMobile S500<br />
ATTR{idVendor}=="<strong>0502</strong>", ATTR{idProduct}=="<strong>33aa</strong>", SYMLINK+="libmtp-%k", ENV{ID_MTP_DEVICE}="1", ENV{ID_MEDIA_PLAYER}="1"`

Затем
  
`sudo udevadm control --reload`
  
либо перезагружаемся.

Устанавливаем пакет для работы с mtp
  
`sudo pacman -S mtpfs`

Редактируем /etc/fuse.conf Раскомментируем строку
  
`user_allow_other`

Создадим какую-нибудь временную директорию и смонтируем в нее телефон.
  
`mkdir /tmp/YOURMOUNTPOINT<br />
mtpfs -o allow_other /tmp/YOURMOUNTPOINT`
  
Размонтируем
  
`fusermount -u /tmp/YOURMOUNTPOINT`

Для удобства можно создать алиасы в ~/.bashrc
  
`alias android-connect="mkdir /tmp/YOURMOUNTPOINT && mtpfs -o allow_other /tmp/YOURMOUNTPOINT"<br />
alias android-disconnect="fusermount -u /mnt/YOURMOUNTPOINT"`