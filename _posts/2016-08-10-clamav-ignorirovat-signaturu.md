---
id: 1864
title: 'Clamav: игнорировать сигнатуру'
date: 2016-08-10T16:47:37+00:00
author: vanoc
layout: post
guid: /?p=1864
permalink: /centos/clamav-ignorirovat-signaturu/
categories:
  - centos
tags:
  - clamav
---
Игнорировать сингатуру в Clamav можно создав файл local.ign2 и добавив в него собственно название сигнатуры.

`echo "Signature" >> /var/lib/clamav/local.ign2`

затем перезапускаем clamav.

Пример, сегодняшний косяк с блокировкой doc файлов

`echo "Win.Exploit.CVE_2016_3316-1" >> /var/lib/clamav/local.ign2`