---
id: 454
title: Кто занял apt базу? в ubuntu 8.10
date: 2009-02-25T13:23:14+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=454
permalink: /ubuntu/kto-zanyal-apt-bazu-v-ubuntu-810/
ljID:
  - "265"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630509"
categories:
  - runix
  - ubuntu
tags:
  - apt
---
Иногда при попытке использования apt случается такое:

`$ sudo aptitude update<br />
E: Не удалось получить доступ к файлу блокировки /var/lib/dpkg/lock - open (11 Resource temporarily unavailable)<br />
E: Unable to lock the administration directory (/var/lib/dpkg/), is another process using it?`

Это обозначает что где то есть процесс который закрыл базу apt для использования. Это могло произойти в случае сбоя программы, которая закрыла базу и забыла ее открыть, или когда где то среди десятков открытых терминалов затерялось окно в котором запущена такая программа.

Посмотрим PID процесса занявший базу apt по лок-файлу

`$ sudo fuser /var/lib/dpkg/lock<br />
/var/lib/dpkg/lock:  22069`

Если есть желание, то можно посмотреть что за программа залочила базу apt

`$ ps aux | grep 22069<br />
root     22069  6.6  1.9  68112 40484 ?        Ss   13:02   0:02 /usr/sbin/synaptic`

Убиваем процесс который занял базу:

`$ sudo fuser -k -TERM /var/lib/dpkg/lock<br />
/var/lib/dpkg/lock:  22069`

или не мудрствуя лукаво

`$ sudo kill -TERM 22069`

найдено на [linsovet.com](http://linsovet.com/apt-fuser-find-lock-pid). надеюсь автор не против. подредактировал для убунту. 

обидно, что не нашел эту статью раньше.