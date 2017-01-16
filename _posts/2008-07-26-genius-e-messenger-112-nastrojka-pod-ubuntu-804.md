---
id: 260
title: Genius E-Messenger 112 настройка под ubuntu 8.04
date: 2008-07-26T14:03:41+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=260
permalink: /ubuntu/genius-e-messenger-112-nastrojka-pod-ubuntu-804/
ljID:
  - "226"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630384"
categories:
  - runix
  - ubuntu
tags:
  - genius
  - вебкамера
---
поздравляю всех с вчерашним днем админа! дело в том, что я сейчас в молдавии. поэтому не мог раньше выйти в инет. сейчас эта проблема решена.

перед отъездом я настраивал вебкамеру Genius E-Messenger 112 на 2-м копме. на нем вторая ось &#8212; убунта. скажу  сказжу сразу, что под XP я так и не смог настроить. дурацкая программа (вместо драйверов) поставляемая с камерой постоянно просила dirext 8. однако настроить в убунту удалось, благодаря [ubuntu](http://forum.ubuntu.ru/index.php?topic=29853) форуму. вообщем, камеру настраивал так:

скачал [gspcav1-20071224.tar.gz](/uploads/gspcav1-20071224.tar.gz), [gspcav1-20071224-emessenger112.patch](/uploads/gspcav1-20071224-emessenger112.patch), [gspcav1-20071224-pixart-vflip.patch](/uploads/gspcav1-20071224-pixart-vflip.patch)

затем выполнил в терминале
  
`tar xzf gspcav1-20071224.tar.gz<br />
cd gspcav1-20071224<br />
patch -p1 <../gspcav1-20071224-emessenger112.patch<br />
patch -p1 <../gspcav1-20071224-pixart-vflip.patch<br />
make<br />
sudo make install<br />
sudo modprobe gspca vflip=1`
  
камера сразу появилась, что меня очень порадовало. однако после перезагрузки пришлось повторить sudo modprobe gspca vflip=1, чтоб она определилась снова.

чтоб этого не делать постоянно, [the1st](http://the1st.net.ru/) посоветовал прописать эту строку в rc.local. итак, выполняем под рутом
  
`gedit /etc/rc.local`
  
и дописываем до exit 0 нужную нам строку (modprobe gspca vflip=1). все :)