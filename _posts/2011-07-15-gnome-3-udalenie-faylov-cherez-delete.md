---
id: 1206
title: Gnome 3 Удаление файлов через Delete
date: 2011-07-15T19:19:06+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1206
permalink: /linux/gnome-3-udalenie-faylov-cherez-delete/
categories:
  - linux
  - runix
tags:
  - gnome3
---
В 3 гноме почему-то для удаления файлов используется сочетание Ctrl+Del. Не знаю зачем это было сделано, возможно из соображений безопасности дабы случайно не удалять файлы.

В любом случае можно вернуть удаление через Delete.

Для этого запускаем **dconf-editor**. Заходим в **org -> gnome -> desktop -> interface** и ставим галочку напротив **can-change-accels** (dconf-editor не закрываем)

В наутилус создаем директорию, выделяем ее. Жмем &#171;Правка&#187; и наводим курсор на строку удаления.

<img class="aligncenter size-full wp-image-1207" title="nautilus, del" src="http://vanoc.ru/uploads/2011/07/1.png" alt="" width="422" height="444" srcset="http://vanoc.ru/uploads/2011/07/1.png 422w, http://vanoc.ru/uploads/2011/07/1-285x300.png 285w" sizes="(max-width: 422px) 100vw, 422px" />

Жмем на клавиатуре клавишу Delete.

<img class="aligncenter size-full wp-image-1208" title="nautilus, del" src="http://vanoc.ru/uploads/2011/07/2.png" alt="" width="364" height="71" srcset="http://vanoc.ru/uploads/2011/07/2.png 364w, http://vanoc.ru/uploads/2011/07/2-300x58.png 300w" sizes="(max-width: 364px) 100vw, 364px" />

Теперь снимаем в **dconf-editor** галочку **can-change-accels.**