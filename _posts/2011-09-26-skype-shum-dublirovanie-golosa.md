---
id: 1225
title: Skype шум, дублирование голоса
date: 2011-09-26T00:59:34+00:00
author: vanoc
layout: post
guid: /?p=1225
permalink: /linux/skype-shum-dublirovanie-golosa/
categories:
  - arch
  - linux
tags:
  - skype
---
Долго искал решение проблемы со скайпом. Наконец-то нашел работающий способ.

Создаем файл **~/.asoundrc** и добавляем в него:

 `# .asoundrc to use skype at the same time as other audio apps like xmms<br />
#<br />
# Successfully tested on an IBM x40 with i810_audio using Linux 2.6.15 and<br />
# Debian unstable with skype 1.2.0.18-API. No sound daemons (asound, esd, etc.)<br />
# running. However, YMMV.<br />
#<br />
# For background, see:<br />
#<br />
# https://bugtrack.alsa-project.org/alsa-bug/view.php?id=1228<br />
# https://bugtrack.alsa-project.org/alsa-bug/view.php?id=1224<br />
#<br />
# (C) 2006-06-03 Lorenzo Colitti - http://www.colitti.com/lorenzo/<br />
# Licensed under the GPLv2 or later`

`pcm.skype {<br />
type asym<br />
playback.pcm "skypeout"<br />
capture.pcm "skypein"<br />
}</p>
<p>pcm.skypein {<br />
# Convert from 8-bit unsigned mono (default format set by aoss when<br />
# /dev/dsp is opened) to 16-bit signed stereo (expected by dsnoop)<br />
#<br />
# We can't just use a "plug" plugin because although the open will<br />
# succeed, the buffer sizes will be wrong and we'll hear no sound at<br />
# all.<br />
type route<br />
slave {<br />
pcm "skypedsnoop"<br />
format S16_LE<br />
}<br />
ttable {<br />
0 {0 0.5}<br />
1 {0 0.5}<br />
}<br />
}</p>
<p>pcm.skypeout {<br />
# Just pass this on to the system dmix<br />
type plug<br />
slave {<br />
pcm "dmix"<br />
}<br />
}</p>
<p>pcm.skypedsnoop {<br />
type dsnoop<br />
ipc_key 1133<br />
slave {<br />
# "Magic" buffer values to get skype audio to work<br />
# If these are not set, opening /dev/dsp succeeds but no sound<br />
# will be heard. According to the alsa developers this is due<br />
# to skype abusing the OSS API.<br />
pcm "hw:0,0"<br />
period_size 256<br />
periods 16<br />
buffer_size 16384<br />
}<br />
bindings {<br />
0 0<br />
}<br />
}<br />
` 

Затем ставим пакет alsa-oss. Перезапускаем alsa.

Запускаем скайп следующим образом:
  
`ALSA_OSS_PCM_DEVICE="skype" aoss skype`

Спасибо <a href="http://archlinux.org.ru/forum/viewtopic.php?f=18&t=3414#p28330" target="_blank">archlinux.org.ru</a>. В очередной раз выручил.

**Upd**: Почему-то на следующий день скайп опять стал выдавать помехи. Решилось удалением скайпа и скачиванием [версии 2.1](http://download.skype.com/linux/skype_static-2.1.0.81.tar.bz2)