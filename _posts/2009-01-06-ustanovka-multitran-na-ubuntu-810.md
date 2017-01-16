---
id: 437
title: установка multitran на ubuntu 8.10
date: 2009-01-06T18:04:28+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=437
permalink: /ubuntu/ustanovka-multitran-na-ubuntu-810/
ljID:
  - "256"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630468"
categories:
  - runix
  - ubuntu
tags:
  - multitran
---
т.к. в последние несколько дней сайт мультитран что-то оч нестабильно работает пришлось установить мультитран на ноут.

поставим необходимые пакеты
  
`sudo aptitude install help2man qt3-dev-tools`
  
часть пакетов можно найти [здесь](http://sourceforge.net/project/showfiles.php?group_id=119871&package_id=135664)

libmtsupport-0.0.1alpha2.tar.bz2
  
libbtree-0.0.1alpha2.tar.bz2
  
libfacet-0.0.1alpha2.tar.bz2

libmtquery-0.0.1alpha3.tar.bz2
  
mt-utils-0.0.1alpha3.tar.bz2

словарь качем [отсюда](http://sourceforge.net/project/showfiles.php?group_id=119871&package_id=135665) &#8212; multitran-data.tar.bz2

[графический интерфейс](http://sourceforge.net/project/showfiles.php?group_id=119871&package_id=142350) &#8212; qmtcc-0.0.1alpha1.tar.bz2

все ссылки на них есть [здесь](http://multitran.sourceforge.net/)

приступим к сборке

**!!!пакеты нужно собирать в строгой последовательности!!!**

<!--more-->


  
`tar -xvjf libmtsupport-0.0.1alpha2.tar.bz2<br />
cd libmtsupport-0.0.1alpha2<br />
make<br />
sudo make install<br />
cd ..`

`tar -xvjf libbtree-0.0.1alpha2.tar.bz2<br />
cd libbtree-0.0.1alpha2<br />
make<br />
sudo make install<br />
cd ..`

`tar -xvjf libfacet-0.0.1alpha2.tar.bz2<br />
cd libfacet-0.0.1alpha2<br />
make<br />
sudo make install<br />
cd ..`

`tar -xvjf libmtquery-0.0.1alpha3.tar.bz2<br />
cd libmtquery-0.0.1alpha3<br />
make<br />
sudo make install<br />
cd ..`

`tar -xvjf mt-utils-0.0.1alpha3.tar.bz2<br />
cd mt-utils-0.0.1alpha3<br />
make<br />
sudo make install<br />
cd ..`

`tar -xvjf multitran-data.tar.bz2<br />
cd multitran-data<br />
sudo make install<br />
cd ..`

`tar -xvjf qmtcc-0.0.1alpha1.tar.bz2<br />
cd qmtcc-0.0.1alpha1`
  
т.к. qmtcc собирается только с qt3 придется указать до него путь. для этого достаточно зайти в ~/qmtcc-0.0.1alpha1/src и отредактировать файл src.pro
  
следует заменить CONFIG += qt warn_on release на CONFIG += /usr/share/qt3
  
`qmake<br />
make<br />
sudo make install<br />
sudo localedef --no-archive -c -i ru_RU -f cp1251 ru_RU.cp1251`
  
запускается мультитран командой
  
`LANG=ru_RU.cp1251 qmtcc`
  
затем можно сделать кнопку в приложениях для запуска мультитрана. для этого создадим файл и впишем с него
  
`#!/bin/bash<br />
echo "запуск мультитран"<br />
LANG=ru_RU.cp1251 qmtcc`
  
теперь можно зайти в систему-параметры-главное меню и добавить новый элемент в раздел например прочее. указав командой только что созданный баш скрипт.
  
да чуть не забыл. скрипту следует выставить права на выполнение как программы. делается это в свойствах файла.

по материалам [opennet.ru](http://www.opennet.ru/openforum/vsluhforumID3/12151.html#1) и [linuxportal.vrn.ru](http://linuxportal.vrn.ru/?q=node/25)