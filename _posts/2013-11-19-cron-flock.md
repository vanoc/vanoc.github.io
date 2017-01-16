---
id: 1549
title: cron flock
date: 2013-11-19T18:39:58+00:00
author: vanoc
layout: post
guid: /?p=1549
permalink: /linux/cron-flock/
categories:
  - linux
tags:
  - cron
  - crontab
  - flock
---
Дабы не плодить процессы в кроне. 

`flock -n /tmp/flock.lock -c "rsync -avz -e ssh 'name@host:/path' /path"`

flock устанавливает блокировку на указанный файл, в случае успеха выполняет нашу команду.