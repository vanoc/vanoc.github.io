---
id: 453
title: Отображение ссылок с кириллицей в firefox
date: 2009-02-25T12:04:45+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=453
permalink: /internet/otobrazhenie-ssylok-s-kirillicej-v-firefox/
ljID:
  - "264"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - Internet
tags:
  - firefox
---
Что бы ссылки с кириллицей не отображались и не копировались из firefox так:

[http://ru.wikipedia.org/wiki/%D0%A3%D1%82%D0%B8%D0%BD%D0%B0%D1%8F_%D1%82%D0%B8%D0%BF%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F](http://ru.wikipedia.org/wiki/Утиная_типизация)

открываем страничку **about:config** и и правим **network.standard-url.escape-utf8** на **false**

Получаем в результате более понятную ссылку <http://ru.wikipedia.org/wiki/Утиная_типизация>