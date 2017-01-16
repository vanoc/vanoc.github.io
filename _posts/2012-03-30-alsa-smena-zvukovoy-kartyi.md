---
id: 1295
title: Alsa смена звуковой карты
date: 2012-03-30T07:41:17+00:00
author: vanoc
layout: post
guid: /?p=1295
permalink: /runix/alsa-smena-zvukovoy-kartyi/
categories:
  - arch
  - runix
tags:
  - Alsa
---
Посмотреть номера устройств можно командой **aplay -l**

Открываем alsa.conf

`sudo vim /usr/share/alsa/alsa.conf`

Правим строки на нужный номер устройства, который получили из aplay -l

`defaults.ctl.card 0<br />
defaults.pcm.card 0`

Перезапускаем alsa.

`sudo /etc/rc.d/alsa restart` 

Проверяем

`aplay /usr/share/sounds/alsa/Front_Center.wav`