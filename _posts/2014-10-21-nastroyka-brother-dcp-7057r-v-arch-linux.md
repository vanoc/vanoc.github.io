---
id: 1704
title: настройка brother DCP-7057R в arch linux
date: 2014-10-21T13:29:59+00:00
author: vanoc
layout: post
guid: /?p=1704
permalink: /arch/nastroyka-brother-dcp-7057r-v-arch-linux/
categories:
  - arch
tags:
  - brother
---
Писал как заметку на память, но может быть кому пригодится.

**Настройка принтера**

`lsusb<br />
Bus 003 Device 004: ID 04f9:0273 Brother Industries, Ltd<br />
` 

Добавим правило в udev
  
`sudo vim /etc/udev/rules.d/10-usbprinter.rules<br />
ATTR{idVendor}=="04f9", ATTR{idProduct}=="0273", MODE:="0664", GROUP:="lp"`

и добавим пользователя в группу lp.

Везде пишут нужно запретить загрузку модуля usblp
  
`sudo vim /etc/modprobe.d/blacklist.conf<br />
blacklist usblp`

Качаем драйвера с <a href="http://support.brother.com/g/b/downloadlist.aspx?c=ru&lang=ru&prod=dcp7057r_eu&os=127&flang=English" target="_blank">официального сайта</a> Generic LPR printer driver (rpm package и Generic CUPSwrapper printer driver (rpm package).

Копируем содержимое скачанных rpm пакетов в соответствующие директории. В принципе достаточно только /opt/ (т.к. только в ней были файлы)

Правим файл /opt/brother/Printers/BrGenML1/inf/setupPrintcap (я не знаю нужен ли этот файл при печати, но тем не менее по дефолту путь не правильный) Нужно изменить строку
  
`PRINTCAP_NAME=/etc/printcap.local<br />
на<br />
PRINTCAP_NAME=/etc/printcap`

Так же требуется сделать симлинк на фильтр
  
`sudo ln -s /opt/brother/Printers/BrGenML1/cupswrapper/brother_lpdwrapper_BrGenML1 /usr/lib/cups/filter`

Затем (пере)запускаем cups
  
`sudo systemctl restart cups.service`

Заходим <a href="http://localhost:631/" target="_blank">http://localhost:631/</a> Добавляем принтер (должен появиться в списке), указываем использовать ppd файл (/opt/brother/Printers/BrGenML1/cupswrapper/brother-BrGenML1-cups-en.ppd)

**Настройка сканера**

`yaourt -S brscan4`
  
или если сетевой
  
`yaourt -S brscan4-network`