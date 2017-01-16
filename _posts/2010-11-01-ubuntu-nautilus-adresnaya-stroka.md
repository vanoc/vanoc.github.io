---
id: 1076
title: Ubuntu. Nautilus. Адресная строка.
date: 2010-11-01T23:29:41+00:00
author: vanoc
layout: post
guid: /?p=1076
permalink: /ubuntu/ubuntu-nautilus-adresnaya-stroka/
categories:
  - runix
  - ubuntu
tags:
  - nautilus
---
В новой, впрочем, как и в прошлой убунте, адресная строка отображается кнопками. Имхо не очень удобно, т.к. нельзя быстро скопировать путь. Решается нажатием **CTRL+L**.

Однако постоянно выполнять и держать эту комбинацию в голове лень, да и не нужно это. Достаточно зайти в **gconf-editor &#8212; apps &#8212; nautilus &#8212; preferences** и поставить галочку напротив **always\_use\_location_entry**. Можно быстрее:

`gconftool -s --type bool /apps/nautilus/preferences/always_use_location_entry true`