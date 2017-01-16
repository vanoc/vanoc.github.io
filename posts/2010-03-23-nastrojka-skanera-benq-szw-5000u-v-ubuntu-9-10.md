---
id: 945
title: Настройка сканера BenQ SZW 5000U в Ubuntu 9.10
date: 2010-03-23T19:00:09+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=945
permalink: /ubuntu/nastrojka-skanera-benq-szw-5000u-v-ubuntu-9-10/
categories:
  - runix
  - ubuntu
tags:
  - xsane
  - сканер
---
Проблема с этим сканером у меня еще с 8.04 версии, но руки дошли настроить только сейчас.

Для начала стоит проверить видит ли система сканер
  
`$ lsusb | grep BenQ<br />
Bus 003 Device 011: ID 04a5:20fc Acer Peripherals Inc. (now BenQ Corp.) Benq 5000`

Теперь закинем файл [u252v072.bin](http://vanoc.ru/files/u252v072.bin.tar.gz) (драйвер, прошивку, если угодно) в _/usr/share/sane/snapscan/_ 
  
Затем следует открыть конфиг
  
`sudo nano /etc/sane.d/snapscan.conf`
  
раскомментировать и отредактировать строку
  
`firmware /usr/share/sane/snapscan/u252v072.bin`

Готово. Можно запускать XSane.

p.s.: Почему-то у меня хорошо сканирует только в черно-белом режиме. При сканировании в цвете XSane выпадает с ошибкой Segmentation fault :( Найду как исправить обновлю пост.