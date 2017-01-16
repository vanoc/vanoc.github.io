---
id: 475
title: ограничение закачки
date: 2009-04-22T12:34:24+00:00
author: vanoc
layout: post
guid: /?p=475
permalink: /ubuntu/ogranichenie-zakachki/
ljID:
  - "273"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630602"
categories:
  - runix
  - ubuntu
tags:
  - trickle
---
Ограничение скорости закачки обновлений Ubuntu 9.04, которая выходит уже завтра:

`sudo aptitude install trickle`

ограничим скорость до 100 КБ/сек

`trickle -d 100 update-manager -d`

Более подробный ман по использованию trickle [здесь](http://debback.blogspot.com/2008/05/blog-post.html) и здесь

`man trickle`