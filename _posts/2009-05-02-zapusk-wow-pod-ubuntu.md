---
id: 479
title: запуск WoW под ubuntu
date: 2009-05-02T14:48:58+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=479
permalink: /igryi/zapusk-wow-pod-ubuntu/
ljID:
  - "275"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630621"
categories:
  - runix
  - ubuntu
  - игры
tags:
  - wow
---
Первое, что необходимо сделать, это включить проприетарный драйвер. Заходим в _&#171;Драйверы устройств&#187;_, устанавливаем и перезагружаемся.

Теперь проверка

`$ glxinfo | grep direct<br />
direct rendering: Yes`

Если получилось, то читаем дальше.

Если вайн не установлен &#8212; устанавливаем. 

`sudo aptitude install wine`

Далее редактируем файл _WoW/WTF/Config.wtf_

Добавляем строки:

`SET gxApi "opengl"<br />
SET ffxDeath "0"<br />
SET ffxGlow "0"<br />
SET M2UseShaders "0"<br />
SET Sound_SoundOutputSystem "1"<br />
SET Sound_SoundBufferSize "150"<br />
SET gxWindow "1"`

Теперь игра должна идти нормально, но есть баг с текстурами в помещениях. Для его исправления подредактируем вайн реестр

`wine regedit`

Заходим в **HKEY\_CURRENT\_USER\Software\Wine\** и создаем ключ **Opengl**
  
В него добавляем строковое значение **DisabledExtensions** и вписываем **GL\_ARB\_vertex\_buffer\_object**

Запускаем вов командой

`wine WoW/wow.exe -opengl`

Баг с текстурами исчез, правда миникарта в помещениях отображается белым.
  
Есть еще один не оч приятный баг. Толи утечка памяти, то ли это текстуры не освобождаются вовремя, но происходит медленное пожирание памяти. Правда в какой-то момент она сама же очищается. Т.ч. по сути не оч страшно, хотя и не приятно.