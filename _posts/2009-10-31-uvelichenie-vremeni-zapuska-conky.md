---
id: 530
title: Увеличение времени запуска conky
date: 2009-10-31T11:52:19+00:00
author: vanoc
layout: post
guid: /?p=530
permalink: /ubuntu/uvelichenie-vremeni-zapuska-conky/
dsq_thread_id:
  - "164630682"
categories:
  - ubuntu
tags:
  - conky
  - sleep
---
Обнаружился непонятный баг в работе conky. С параметром _own\_window\_type normal_, в файле .conkyrc, наблюдается сдвиг фонового изображения

<img class="alignnone size-full wp-image-531" title="conky" alt="conky" src="/uploads/2009/10/conky.png" width="359" height="283" srcset="/uploads/2009/10/conky.png 359w, /uploads/2009/10/conky-300x236.png 300w" sizes="(max-width: 359px) 100vw, 359px" />

Если изменить параметр на _own\_window\_type override_ или _own\_window\_type desktop_ фоновое изображение показывается нормально, без сдвигов. Однако при включении компьютера получается так, что обои рабочего стола загружаются позже conky, тем самым его перекрывая. Поэтому решил увеличить время загрузки conky, чтобы сперва грузились обои и только потом уже conky.  Помогла команда sleep.
  
`sh -c 'sleep 30s && conky'`
  
или
  
`conky -p 30`