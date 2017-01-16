---
id: 245
title: virtualbox и ubuntu
date: 2008-07-02T21:21:23+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=245
permalink: /archive/virtualbox-i-ubuntu/
ljID:
  - "210"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - архив
tags:
  - VirtualBox
---
небольшой фак, больше для себя, чтоб не забыть как ставил. заходим в synaptic ищем virtualbox и устанавливаем. запускаем, настраиваем, что нужно, нажимаем старт и выдает
  
`VBox status code: -1908 (VERR_VM_DRIVER_NOT_INSTALLED)`
  
вылечил так. заходим в synaptic ищем virtualbox и среди того что выдало находим
  
`virtualbox-ose-modules-generic`
  
устанавливаем. теперь при запуске выдает
  
`VBox status code: -1909 (VERR_VM_DRIVER_NOT_ACCESSIBLE)`
  
одноразовое решение (при каждом запуске прийдется повторять). набираем в консоли
  
`sudo chmod 666 /dev/vboxdrv`
  
кого это напрягает делаем так. заходим в &#8216;систему&#8217; &#8212; &#8216;администрирование&#8217; &#8212; &#8216;пользователи и группы&#8217;. жмем &#8212; &#8216;manage groups&#8217;. находим &#8216;vboxusers&#8217; жмем свойства и ставим галочку напротив своего пользователя.