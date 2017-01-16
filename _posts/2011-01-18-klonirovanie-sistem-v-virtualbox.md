---
id: 1140
title: Клонирование систем в Virtualbox
date: 2011-01-18T13:31:11+00:00
author: vanoc
layout: post
guid: /?p=1140
permalink: /ubuntu/klonirovanie-sistem-v-virtualbox/
categories:
  - linux
  - ubuntu
tags:
  - VirtualBox
---
Склонировать систему в Virtualbox можно выполнив

`VBoxManage clonevdi система.vdi система_new.vdi`

Копирование и переименование не помогает из-за одинаковых UUID.