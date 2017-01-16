---
id: 277
title: отключаем мерцание в онлайн видео
date: 2008-08-11T20:26:16+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=277
permalink: /ubuntu/otklyuchaem-mercanie-onlajn-video/
ljID:
  - "229"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630403"
categories:
  - runix
  - ubuntu
tags:
  - compiz
---
мне надоело мерцание видео в скайпе, а так же в онлайн тв. причина была в compizе. отключается в убунте в настройках внешнего вида. выставляем галочку &#8212; Без эффектов.

так же его можно вообще снести. делается это так. набираем в терминале
  
`dpkg --list | grep compiz`
  
все что выдало сносим
  
`sudo aptitude remove compiz-core compiz-fusion-plugins-extra compiz-fusion-plugins-main compiz-gnome compiz-plugins compizconfig-backend-gconf libcompizconfig0`
  
чтоб не перезагружать комп выполняем
  
`metacity --replace`
  
запустил скайп. больше не мерцает :)