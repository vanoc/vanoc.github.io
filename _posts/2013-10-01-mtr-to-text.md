---
id: 1518
title: mtr в текстовый файл
date: 2013-10-01T23:51:03+00:00
author: vanoc
layout: post
guid: /?p=1518
permalink: /linux/mtr-to-text/
categories:
  - linux
tags:
  - mtr
---
Я уже писал о My traceroute. Сегодня мне понадобилось получить вывод удобный для копирования. Оказывается все уже придумано.

`mtr --report --report-cycles 10 ya.ru > ya.ru.txt`