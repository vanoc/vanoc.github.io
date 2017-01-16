---
id: 1011
title: Yota WiMax Samsung SWC-U200 на ubuntu 10.04
date: 2010-09-04T19:47:29+00:00
author: vanoc
layout: post
guid: /?p=1011
permalink: /ubuntu/yota-wimax-samsung-swc-u200-na-ubuntu-10-04/
categories:
  - ubuntu
tags:
  - yota
---
<img class="alignright size-full wp-image-1016" title="yota" src="/uploads/2010/09/yota.png" alt="" width="150" height="141" />Заметка на память.

Т.к. в репозиториях ubuntu 10.04 пакет madwimax присутствует, установка сводится к одной команде

`sudo aptitude install madwimax`

Затем создадим файл

`sudo nano /etc/udev/rules.d/60-madwimax.rules` 

с таким содержимым

`# udev rules file for madwimax  supported devices<br />
SUBSYSTEM!="usb|usb_device",  GOTO="madwimax_rules_end"<br />
ACTION!="add", GOTO="madwimax_rules_end"<br />
ATTR{idVendor}=="04e8",  ATTR{idProduct}=="6761", RUN+="//sbin/madwimax -qd  --exact-device=$attr{busnum}/$attr{devnum}"<br />
ATTR{idVendor}=="04e9",  ATTR{idProduct}=="6761", RUN+="//sbin/madwimax -qd  --exact-device=$attr{busnum}/$attr{devnum}"<br />
LABEL="madwimax_rules_end"`

Всё. Втыкаем модем интернет должен сразу появиться.

По материалам [forum.ubuntu.ru](http://forum.ubuntu.ru/index.php?topic=94235.msg714806#msg714806)