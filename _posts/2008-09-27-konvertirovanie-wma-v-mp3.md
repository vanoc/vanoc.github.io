---
id: 324
title: конвертирование wma в mp3
date: 2008-09-27T14:54:24+00:00
author: vanoc
layout: post
guid: http://helicopter.net.ru/?p=324
permalink: /ubuntu/konvertirovanie-wma-v-mp3/
ljID:
  - "238"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
categories:
  - runix
  - ubuntu
tags:
  - mp3
  - wma
---
для этого нам потребуется mplayer и lame.
  
`sudo aptitude install mplayer lame`
  
создаем текстовик. назовем его например wma2mp3. вставляем в него эти строки
  
``#!/bin/bash<br />
#<br />
# Dump wma to mp3<br />
for i in *.wma<br />
do<br />
if [ -f "$i" ]; then<br />
rm -f "$i.wav"<br />
mkfifo "$i.wav"<br />
mplayer -quiet -vo null -vc dummy -af volume=0,resample=44100:0:1 -ao pcm:waveheader:file="$i.wav" "$i" &<br />
dest=`echo "$i"|sed -e 's/wma$/mp3/'`<br />
lame -V0 -h -b 160 --vbr-new "$i.wav" "$dest"<br />
rm -f "$i.wav"<br />
fi<br />
done``
  
укажем права запуска
  
`chmod +x wma2mp3`
  
либо в свойствах файла указываем запускать как программу.
  
далее можно закинуть этот файл в /usr/local/bin/ запуск будет выглядеть так
  
`wma2mp3 *.wma`
  
если не закидывать wma2mp3 в bin запуск выглядит так
  
`/home/user/wma2mp3 *.wma`