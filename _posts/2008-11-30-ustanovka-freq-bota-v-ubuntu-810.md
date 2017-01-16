---
id: 405
title: установка freq бота в ubuntu 8.10
date: 2008-11-30T22:48:55+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=405
permalink: /ubuntu/ustanovka-freq-bota-v-ubuntu-810/
ljID:
  - "251"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630451"
categories:
  - runix
  - ubuntu
tags:
  - bot
  - freq
  - jabber
---
ставим дополнительные пакеты
  
`sudo aptitude install subversion python-twisted python-crypto`
  
качаем и собираем freq бота
  
`svn co http://cvs.berlios.de/svnroot/repos/freq-dev/trunk/ freq<br />
cd freq<br />
./configure<br />
make<br />
sudo make install`

`sudo adduser --system --disabled-login --no-create-home --home /var/freqbot --group freqbot<br />
sudo mkdir -p /var/freqbot<br />
sudo chown freqbot:freqbot /var/freqbot<br />
sudo chmod 750 /var/freqbot<br />
sudo mkdir -p /var/log/freqbot<br />
sudo chown freqbot:freqbot /var/log/freqbot<br />
sudo chmod 750 /var/log/freqbot`
  
заходим в /usr/local/etc и переименовываем freqbot.conf.sample в freqbot.conf
  
затем настраиваем его под себя. для бота придется создать jabber аккаунт и добавить его себе в ростер.

управление ботом
  
`sudo /usr/local/sbin/freqtool start`
  
пишем боту в личку, например,
  
`.join chillout@conference.jabber.ru имя_бота<br />
.leave chillout@conference.jabber.ru`
  
отключаем бота
  
`sudo /usr/local/sbin/freqtool stop`