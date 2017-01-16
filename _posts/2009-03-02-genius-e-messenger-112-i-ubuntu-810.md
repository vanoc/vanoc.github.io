---
id: 459
title: Genius E-Messenger 112 и ubuntu 8.10
date: 2009-03-02T10:33:10+00:00
author: vanoc
layout: post
guid: /?p=459
permalink: /ubuntu/genius-e-messenger-112-i-ubuntu-810/
ljID:
  - "267"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630555"
categories:
  - runix
  - ubuntu
tags:
  - genius
  - вебкамера
---
Знаю, что немного запоздалый пост, т.к. в апреле уже выйдет новая убунта, но только вчера руки дошли настроить эту камеру.

Для начала скачал свежие библиотеки с [linuxtv.org](http://linuxtv.org/hg/v4l-dvb/)

[<img class="alignnone size-medium wp-image-460" title="linuxtv.org" src="/uploads/d181d0bdd0b8d0bcd0bed0ba1-300x42.jpg" alt="linuxtv.org" width="300" height="42" srcset="/uploads/d181d0bdd0b8d0bcd0bed0ba1-300x42.jpg 300w, /uploads/d181d0bdd0b8d0bcd0bed0ba1.jpg 768w" sizes="(max-width: 300px) 100vw, 300px" />](/uploads/d181d0bdd0b8d0bcd0bed0ba1.jpg)

далее
  
`make<br />
sudo make install`

Теперь вебкамера заработала, но с помехами. Чтобы картинка отображалась нормально запустил скайп командой
  
`LD_PRELOAD=/usr/lib/libv4l/v4l2convert.so skype`
  
Правда изображение получилось вверх ногами :) Хотя это уже не важно. Главное, что вообще работает :)

Затем можно подправить кнопку запуска скайпа. Для этого достаточно создать файл например .skype в домашней директории и вписать в него

`#!/bin/bash<br />
LD_PRELOAD=/usr/lib/libv4l/v4l2convert.so skype`

Затем зайти в Систему-Параметры-Главное меню-Интернет выбрать Skype и в свойствах указать командой запуска только что созданный баш скрипт .skype

Да чуть не забыл. Скрипту следует выставить права на выполнение как программы. Делается это в свойствах файла.

ps если найду рабочий способ как перевернуть изображение обязательно обновлю пост.