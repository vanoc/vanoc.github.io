---
id: 240
title: настройка звука в ubuntu на asus x50sl
date: 2008-06-21T15:21:20+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=240
permalink: /ubuntu/nastrojka-zvuka-v-ubuntu-na-asus-x50sl/
ljID:
  - "206"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - runix
  - ubuntu
tags:
  - asus
  - звук
---
поздравьте меня! приобрели отличный ноут asus x50sl. гы. доволен как слон :)

сейчас по делу. поставил рядом с вистой (шла по дефолту) убунту 8.04. в винде звук зарабтал. в убунте нет. после более часа гугления решение нашлось.

выполняем в консоли под рутом
  
`gedit /etc/modprobe.d/alsa-base`
  
дописываем в конец файла
  
`options snd-hda-intel enable=1 index=0 model=lenovo`
  
сохраняем. перезагружаемся.

результат &#8212; звучащая мелодия при загрузке (первый раз был рад ее слышать:)