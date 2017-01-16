---
id: 1082
title: прозрачность conky в KDE
date: 2010-11-11T02:12:27+00:00
author: vanoc
layout: post
guid: /?p=1082
permalink: /ubuntu/prozrachnost-conky-v-kde/
categories:
  - runix
  - ubuntu
tags:
  - conky
---
Чтобы сделать фон conky в KDE прозрачным достаточно добавить в конфиг файл .conkyrc строку
  
`own_window_argb_visual yes`
  
Так же следует обратить внимание на параметры:
  
`own_window_transparent yes<br />
own_window_type normal`
  
Строку с указанием цвета фона удаляем или делаем не активной
  
`#own_window_colour black`

Пример: мой файл [.conkyrc](/files/.conkyrc)