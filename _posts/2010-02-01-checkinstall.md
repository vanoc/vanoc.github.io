---
id: 804
title: checkinstall
date: 2010-02-01T23:55:15+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=804
permalink: /ubuntu/checkinstall/
categories:
  - runix
  - ubuntu
tags:
  - checkinstall
---
Утилита checkinstall предлагает заменять команду **make install**. Т.о. сборка выглядит так:
  
`./configure<br />
make<br />
sudo checkinstall`
  
После чего checkinstall установит, создаст .deb пакет и сохранит его в этой же директории.

Подробности как всегда
  
`man checkinstall`
  
Преимущества: можно удалять стандартными средствами (synaptic, aptitude remove, aptitude purge и т.д.), создается DEB, RPM, Slackware пакет.