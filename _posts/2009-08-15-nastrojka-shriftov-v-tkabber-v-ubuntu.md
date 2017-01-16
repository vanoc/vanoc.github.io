---
id: 504
title: настройка шрифтов tkabber в ubuntu
date: 2009-08-15T22:35:30+00:00
author: vanoc
layout: post
guid: /?p=504
permalink: /ubuntu/nastrojka-shriftov-v-tkabber-v-ubuntu/
ljID:
  - "281"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630660"
categories:
  - runix
  - ubuntu
tags:
  - tkabber
---
После установки tkabber шрифты в нем отображается ужасно. Для исправления достаточно начать использовать Tk 8.5 вместо 8.4.

Установим tcl8.5 и tk8.5
  
`sudo aptitude install tcl8.5 tk8.5`
  
Затем выберем, что использовать, указав цифрой wish8.5
  
``sudo update-alternatives --config wish<br />
Есть 2 альтернатив, которые предоставляют `wish'.<br />
  Выбор        Альтернатива<br />
-----------------------------------------------<br />
*+        1    /usr/bin/wish8.4<br />
          2    /usr/bin/wish8.5<br />
Нажмите enter, чтобы сохранить значение по умолчанию[*], или введите выбранное число: 2<br />
Используется `/usr/bin/wish8.5' для предоставления `wish'.``
  
Теперь можно перезапустить tkabber.

найдено на [sovety.blogspot.com](http://sovety.blogspot.com/2009/03/cyrillic-fonts-in-tcltk-and-pythontk.html)