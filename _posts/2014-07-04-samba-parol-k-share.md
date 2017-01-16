---
id: 1675
title: samba, пароль к шаре
date: 2014-07-04T18:01:09+00:00
author: vanoc
layout: post
guid: /?p=1675
permalink: /centos/samba-parol-k-share/
categories:
  - centos
tags:
  - samba
  - winbind
---
Столкнулся с тем, что windows начала просить пароль на доступ к шаре.

В логах /var/log/samba/log.smbd следующее
  
`smbd/server.c:1165(main)<br />
 standard input is not a socket, assuming -D option<br />
smbd/server.c:500(smbd_open_one_socket)<br />
 smbd_open_once_socket: open_socket_in: Address already in use`

лог /var/log/samba/log.nmbd показывает
  
`nmbd/nmbd.c:885(main)<br />
  standard input is not a socket, assuming -D option`

Проблема оказалась в winbindе. А именно не соответствии имен групп linux и windows. Т.е. группа шары выглядела так:
  
`# ls -l /mnt/lv10/Photoarchive/<br />
total 4<br />
drwxrwx---+  2 root 16777729 4096 Apr 24  2013 Архив`

где gid=16777729 (domain users)

Лечится рестартом winbind
  
`service winbind restart`