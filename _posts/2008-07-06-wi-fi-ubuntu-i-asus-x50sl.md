---
id: 247
title: wi-fi ubuntu и asus x50sl
date: 2008-07-06T18:06:19+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=247
permalink: /ubuntu/wi-fi-ubuntu-i-asus-x50sl/
ljID:
  - "212"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630380"
categories:
  - runix
  - ubuntu
tags:
  - asus
  - wi-fi
---
на днях настраивал wi-fi на ноуте. думаю пригодится. однако проверить в работе пока не смог. хотя вроде корбина есть, но это в пару кварталах. собственно сам процесс настройки:

в консоли
  
`sudo aptitude install build-essential`
  
качаем самый последний драйвер <http://snapshots.madwifi-project.org/madwifi-hal-0.10.5.6/>
  
`cd madwifi*<br />
make<br />
sudo make install<br />
sudo modprobe ath_pci<br />
sudo reboot`
  
по-идее все должно работать. как проверю обязательно обновлю пост.

UPD: все работает :)