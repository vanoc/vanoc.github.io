---
id: 1437
title: Ubuntu 12.04 отключение загрузки иксов
date: 2013-02-14T10:39:11+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1437
permalink: /ubuntu/ubuntu-12-04-otklyuchenie-zagruzki-iksov/
categories:
  - runix
  - ubuntu
tags:
  - grub
---
Отключить запуск unity и вообще графической оболочки в ubuntu 12.04 можно подправив файл /etc/default/grub

Нужно изменить строку
  
`GRUB_CMDLINE_LINUX_DEFAULT="quiet splash"`
  
на
  
`GRUB_CMDLINE_LINUX_DEFAULT="text"`
  
и выполнить
  
`sudo update-grub`