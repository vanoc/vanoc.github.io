---
id: 258
title: Permissoin denied
date: 2008-07-17T23:41:54+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=258
permalink: /ubuntu/permissoin-denied/
ljID:
  - "225"
openid_comments:
  - 'a:1:{i:0;s:3:"411";}'
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630382"
categories:
  - runix
  - ubuntu
tags:
  - transmission
---
напугал меня вчера Transmission. стал выдавать на все принимаемые закачки &#171;Permissoin denied&#187;. те, что уже закачаны раздавались нормально. первая мысль &#8212; забанили на трекере. однако программа выдала такую же ошибку и с другими трекерами. решил проверить диск. оказалось что сбились права доступа к ntfs дискам. раньше с defaults,nls=utf8,umask=0222 все работало. выставил
  
`defaults,nls=utf8,umask=007,gid=46`
  
перезагрузился. права вернулись.