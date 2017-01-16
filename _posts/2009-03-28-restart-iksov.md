---
id: 467
title: рестарт иксов
date: 2009-03-28T21:32:29+00:00
author: vanoc
layout: post
guid: /?p=467
permalink: /ubuntu/restart-iksov/
ljID:
  - "270"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630580"
categories:
  - runix
  - ubuntu
tags:
  - ubuntu
---
В ubuntu 9.04 по дефолту отключена возможность перезагружать иксы по ctrl+alt+backspase. Один из способов перезагрузки &#8212; ctrl+alt+F1 (выход из терминала ctrl+alt+F7) и набрать
  
`sudo /etc/init.d/gdm stop`
  
Причем в KDE gdm заменяется на kdm. Загрузить можно так же
  
`sudo /etc/init.d/gdm start`
  
Запускать в данном случае через startx не советую. По крайней мере у меня иксы грузятся с ошибками.