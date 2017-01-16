---
id: 1265
title: android, wifi и minidlna
date: 2011-11-04T20:33:15+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1265
permalink: /runix/android-wifi-i-minidlna/
categories:
  - arch
  - runix
tags:
  - android
  - dlna
  - minidlna
---
Так уж сложилось, что сегодня пятница, есть свободное время, а так же несколько устройств с андройдом, комп с арчем и wifi точка.

Как следствие установка **minidlna** и просмотр фильмов находящихся на компе с планшета.

В арче Minidlna ставится командой
  
`sudo yaourt -S minidlna`

Вся настройка сводится к редактированию файла **/etc/minidlna.conf**
  
В нем достаточно указать пути до директорий с музыкой и фильмами
  
`media_dir=A,/media/sda5/music<br />
media_dir=V,/media/sda5/films`
  
раскомментировать и как-то назвать свой комп
  
`friendly_name=vanocpc`
  
а также подправить интервал обновления медиатеки
  
`notify_interval=60`

Теперь можно смело запускать
  
`sudo /etc/rc.d/minidlna start`

Так же надо бы добавить minidlna к демонам в /etc/rc.conf для автозапуска.

**Upd**: лучше все-таки добавить в автозапуск иксов. Т.к. на момент запуска демонов wifi не поднят и minidlna не стартует.

Для просмотра видео с андройда установил BubbleUPnP. Проблем с кодировкой нет, видео запускается с задержкой ~3-4 секунды, перемотка работает великолепно.

**Upd**: в итоге отказался от использования minidlna и ushare установив vsftpd на комп, ES explorer и mx video player на планшет.