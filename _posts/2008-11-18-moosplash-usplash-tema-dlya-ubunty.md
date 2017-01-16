---
id: 391
title: 'moosplash &#8212; usplash тема для убунты'
date: 2008-11-18T23:23:02+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=391
permalink: /ubuntu/moosplash-usplash-tema-dlya-ubunty/
ljID:
  - "249"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - runix
  - ubuntu
tags:
  - usplash
---
заменяем стандартный ubuntu usplash на moosplash

 <img class="alignnone size-medium wp-image-393" title="usplash-default" src="http://vanoc.ru/uploads/usplash-default-300x178.jpg" alt="" width="145" height="86" /><img class="alignnone size-medium wp-image-392" title="moo" src="http://vanoc.ru/uploads/moo-300x187.jpg" alt="" width="143" height="86" />

для установки нужно отредактировать sources.list
  
`sudo gedit /etc/apt/sources.list`
  
добавить следующие строки
  
для 8.10
  
`deb http://ppa.launchpad.net/corenominal/ubuntu intrepid main<br />
deb-src http://ppa.launchpad.net/corenominal/ubuntu intrepid main`
  
для 8.04
  
`deb http://ppa.launchpad.net/corenominal/ubuntu hardy main<br />
deb-src http://ppa.launchpad.net/corenominal/ubuntu hardy main`
  
обновить списки пакетов
  
`sudo aptitude update`
  
устанавливаем moosplash и StartUp Manager
  
`sudo aptitude install moosplash startupmanager`
  
теперь заходим в &#171;Систему &#8212; Администрирование &#8212; StartUp Manager&#187;. вторая вкладка &#8212; &#171;Внешний вид&#187;. меняем usplash тему на moosplash. выходим. перезагружаемся.

теперь при включении и выключении компа можно видеть вот такую забавную коровку

<img class="alignnone size-full wp-image-392" title="moo" src="http://vanoc.ru/uploads/moo.jpg" alt="" width="463" height="289" />