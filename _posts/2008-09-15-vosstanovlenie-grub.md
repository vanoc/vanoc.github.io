---
id: 319
title: восстановление grub
date: 2008-09-15T17:37:29+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=319
permalink: /ubuntu/vosstanovlenie-grub/
ljID:
  - "236"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630429"
categories:
  - runix
  - ubuntu
tags:
  - grub
---
т.к. виста, которая попала ко мне с покупкой ноута, стала тормозить жутко было принято решение снести ее нафиг и поставить XP, что успешно и проделал. однако запарол груб. восстановил его выполнив это неслабое заклинание
  
`sudo grub<br />
find /boot/grub/stage1<br />
root (hdx,y)<br />
setup (hdx)<br />
quit`
  
где x, y это цифры, которые выдаст find. стоит обратить внимание, что setup (hdx) выполняется без &#171;y&#187; !!!