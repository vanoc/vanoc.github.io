---
id: 1301
title: KDE отключение\настройка тачпада
date: 2012-03-31T16:09:35+00:00
author: vanoc
layout: post
guid: /?p=1301
permalink: /arch/kde-otklyuchenie-nastroyka-tachpada/
categories:
  - arch
tags:
  - synaptiks
  - touchpad
  - тачпад
---
Давно мучал вопрос отключения тачпада при подключенной мышке и вот сегодня дошли руки. Решается все по сути установкой **synaptiks**. В арче он есть в ауре.

`sudo yaourt -S synaptiks`

Затем в Служебных находим Touchpad management

[<img class="aligncenter size-medium wp-image-1302" title="Touchpad management " src="/uploads/2012/03/synaptiksmanagement-300x219.png" alt="" width="300" height="219" srcset="/uploads/2012/03/synaptiksmanagement-300x219.png 300w, /uploads/2012/03/synaptiksmanagement.png 725w" sizes="(max-width: 300px) 100vw, 300px" />](/uploads/2012/03/synaptiksmanagement.png)
  
Быстро включить тачпад можно из панели задач

<img class="aligncenter size-full wp-image-1304" title="Touchpad management " src="/uploads/2012/03/synaptiksmanagement1.png" alt="" width="305" height="232" srcset="/uploads/2012/03/synaptiksmanagement1.png 305w, /uploads/2012/03/synaptiksmanagement1-300x228.png 300w" sizes="(max-width: 305px) 100vw, 305px" />

**Update 22/06/2014:** Проект Synaptiks больше не поддерживается. Можно заменить пакетом kcm-touchpad.