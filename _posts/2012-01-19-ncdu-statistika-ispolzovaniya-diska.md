---
id: 1280
title: ncdu статистика использования диска
date: 2012-01-19T00:09:54+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1280
permalink: /linux/ncdu-statistika-ispolzovaniya-diska/
categories:
  - linux
  - runix
tags:
  - ncdu
---
Консольный аналог статистики использования диска kdusader-a и т.п. Простая и удобная утилита. IMHO придется по вкусу тем, кому недостаточно дефолтного du.
  
Понравилось возможность выводить информацию по определенным разделам.
  
`sudo ncdu -x /`
  
<img class="aligncenter size-full wp-image-1281" title="ncdu" src="http://vanoc.ru/uploads/2012/01/ncdu.png" alt="" width="500" height="383" srcset="http://vanoc.ru/uploads/2012/01/ncdu.png 500w, http://vanoc.ru/uploads/2012/01/ncdu-300x229.png 300w" sizes="(max-width: 500px) 100vw, 500px" />
  
Утилита умеет удалять, пересчитывать, сортировать и прочее. Полная информация в man и shift+? в программе.