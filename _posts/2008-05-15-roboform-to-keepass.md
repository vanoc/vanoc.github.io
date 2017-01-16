---
id: 236
title: roboform to keepass
date: 2008-05-15T22:42:48+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=236
permalink: /ubuntu/roboform-to-keepass/
ljID:
  - "202"
categories:
  - ubuntu
tags:
  - keepass
  - roboform
---
В windows для хранения большинства паролей использовал roboform. С переходом на ubuntu пришлось искать способ как перенести пароли в keepass, т.к. версии под линукс roboform-a нет. Нашел вот такое решение.

В roboform жмем печать списка и сохраняем пароли в .htm файл. Открываем его текстовиком и сохраняем в кодировке ANSI. Качаем и запускаем вот этот [файлик](http://www.box.net/shared/o7mdcgl4wg). Указываем ему путь до .htm файла и получаем полноценный .csv файл. Заходим в keepass и импортируем.