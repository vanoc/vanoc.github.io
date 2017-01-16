---
id: 1598
title: Arch linux настройка яркости
date: 2014-03-26T11:50:56+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1598
permalink: /arch/arch-linux-nastroyka-yarkosti/
categories:
  - arch
tags:
  - kde
---
Не работала регулировка яркости. Моему ноутбуку Dell Inspirion 3521 этот способ помог. Две видеокарты, по дефолту система загружается с интеловской.

<pre>Section "Device"
        Identifier	"Intel Graphics"
        Driver		"Intel"
        Option		"Backlight" "intel_backlight"
EndSection</pre>

Прописываем в /etc/X11/xorg.conf.d/20-intel.conf
  
Перезагружаемся.