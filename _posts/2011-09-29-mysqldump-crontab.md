---
id: 1236
title: mysqldump crontab
date: 2011-09-29T08:58:30+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1236
permalink: /blog/mysqldump-crontab/
categories:
  - linux
  - блог
tags:
  - backup
  - crontab
  - mysqldump
---
В связи со взломами блога озадачился созданием бэкапов

``01 03 */2 * * mysqldump -hlocalhost -uname -ppassword database > /home/name/backup/`date +\%Y-\%m-\%d`-database.sql<br />
10 03 */2 * * find /home/name/backup/ -name "*.sql" -mtime +10 -delete``