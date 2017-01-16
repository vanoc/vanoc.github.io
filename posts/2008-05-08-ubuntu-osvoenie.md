---
id: 230
title: ubuntu. освоение
date: 2008-05-08T14:58:29+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=230
permalink: /ubuntu/ubuntu-osvoenie/
ljID:
  - "197"
dsq_thread_id:
  - "164630316"
categories:
  - runix
  - ubuntu
tags:
  - учимся
---
поставил я таки себе вчера ubuntu. сегодня занялся ее настройкой. первым делом обновил систему. оказалось что уже вышло 57 обновлений. шустро они. далее выставил в gedit (текстовик) кодировку win-1251 по умолчанию. потом поставил виндовые шрифты ибо в лисе без них многое криво отображается. далее поставил wine (программка для запуска виндовых приложений). затем поставил amaroK (настроил заодно кодировку), keepass, azureus. на очереди настройка клавы, локальной сети, установка psi 12 и т.д. пока еще не решил что еще.

под катом основные моменты. <!--more-->

обновление системы
  
`$sudo aptitude update`
  
для настройки кодировки в gedit и amaroK заглядываем <a href="http://lug-wiki.nnov.ru/index.php/Ubuntu_Desktop_Tuning" target="_blank">сюда</a>. там все хорошо расписано. ничего сложного.

виндовые шрифты
  
`$sudo aptitude install msttcorefonts`
  
wine, azureus и keepass соответственно
  
`$sudo aptitude install wine azureus keepassx`