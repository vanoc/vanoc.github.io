---
id: 618
title: Gparted и ntfs
date: 2009-11-09T16:25:22+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=618
permalink: /ubuntu/gparted-i-ntfs/
dsq_thread_id:
  - "164630688"
categories:
  - runix
  - ubuntu
tags:
  - gparted
  - ntfs
---
По дефолту Gparted форматировать в формат NTFS не умеет. Чтобы научить его этому достаточно установить пакет ntfsprogs и перезапустить Gparted.

`sudo aptitude install ntfsprogs`

Навеяно  <img class="alignnone size-full wp-image-719" title="LJ userinfo" src="http://vanoc.ru/uploads/2009/11/userinfo.gif" alt="" width="17" height="17" />[phoa](http://phoa.livejournal.com/4036.html)