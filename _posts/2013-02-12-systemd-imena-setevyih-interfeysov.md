---
id: 1434
title: Systemd имена сетевых интерфейсов
date: 2013-02-12T22:15:14+00:00
author: vanoc
layout: post
guid: /?p=1434
permalink: /linux/systemd-imena-setevyih-interfeysov/
categories:
  - arch
  - linux
  - runix
tags:
  - systemd
---
В связи с переходом на systemd имена сетевых интерфейсов теперь генерируются для каждого устройства индивидуально. Они постоянны и не меняются, даже если несколько сетевух.

Вернуть привычные eth0 и wlan0 можно так:

`sudo ln -s /dev/null /etc/udev/rules.d/80-net-name-slot.rules`

Более подробно, а так же о преимуществах здесь <a href="http://www.freedesktop.org/wiki/Software/systemd/PredictableNetworkInterfaceNames" title="freedesktop.org" target="_blank">freedesktop.org</a>