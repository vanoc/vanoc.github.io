---
id: 738
title: Поиск и замена текста в нескольких файлах
date: 2010-01-11T15:39:51+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=738
permalink: /ubuntu/poisk-i-zamena-teksta-v-neskolkix-fajlax/
dsq_thread_id:
  - "164630722"
categories:
  - ubuntu
tags:
  - perl
  - sed
---
Чтобы заменить foo на bar в нескольких файлах, выполните следующую команду:
  
`perl -pi~ -e 's/foo/bar/' [files]`
  
либо
  
`sed -i 's/foo/bar/' [files]`

источник [linsovet.com](http://linsovet.com/find_and_replace_text_in_multiple_files)