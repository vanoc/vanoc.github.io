---
id: 387
title: установка psi из git-a
date: 2008-11-17T23:07:24+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=387
permalink: /ubuntu/ustanovka-psi-iz-git-a/
ljID:
  - "248"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - runix
  - ubuntu
tags:
  - psi
---
сделал краткую заметку для себя. надеюсь [Erik](http://edstudio.net.ru/index.php?go=23) не против.

ставим дополнительные пакеты
  
`sudo aptitude install git-core libqt4-dev libqca2 libqca2-dev libqca2-plugin-ossl g++`
  
установка
  
`git clone git://git.psi-im.org/psi.git<br />
cd psi<br />
git submodule init<br />
git submodule update<br />
./configure<br />
make<br />
sudo make install`
  
обновление
  
`cd psi<br />
make distclean<br />
git pull<br />
git submodule update<br />
./configure<br />
make<br />
sudo make install`