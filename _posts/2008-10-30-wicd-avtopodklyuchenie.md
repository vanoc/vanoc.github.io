---
id: 354
title: Wicd автоподключение
date: 2008-10-30T13:10:58+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=354
permalink: /ubuntu/wicd-avtopodklyuchenie/
ljID:
  - "243"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - runix
  - ubuntu
tags:
  - wicd
---
Пост скорее для себя, чтоб не забыть.

По совету [ризна](http://blog.rizn.org/wicd-network-manager/) поставил [wicd](http://wicd.sourceforge.net/). Программа заменяющая стандартный network-manager как в гноме так и в кде.

Wicd к сети автоматически не подключается, несмотря на то, что сеть видит и показывает. Однако это можно подправить. Инет у меня идет от роутера. DHCP поднят, поэтому в /etc/network/interfaces дописал
  
`auto eth0<br />
iface eth0 inet dhcp`
  
Если бы DHCP не был поднят
  
`auto eth0<br />
iface eth0 inet static<br />
address 192.168.1.х<br />
netmask 255.255.255.0<br />
gateway 192.168.1.х`
  
Спасибо Ризну и Оябу за помощь.