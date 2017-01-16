---
id: 488
title: установка sulci бота в ubuntu 9.04
date: 2009-08-10T19:46:03+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=488
permalink: /ubuntu/ustanovka-sulci-bota-v-ubuntu-9-04/
ljID:
  - "279"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630657"
categories:
  - runix
  - ubuntu
tags:
  - bot
  - jabber
  - sulci
---
Sulci &#8212; это jabber бот от ermine. В настоящее время один из самых распространенных в конференциях jabber. Список команд можно просмотреть [здесь](http://wiki.jrudevels.org/index.php/Sulci).

Sulci взять можно отсюда [files.jabber.ru/sulci](http://files.jabber.ru/sulci/).

Первоначально для сборки потребуется установить некоторые пакеты (~35mb)

`sudo aptitude install ocaml-native-compilers ocaml-findlib libocamlnet-ocaml libocamlnet-ocaml-dev ocaml-ulex libssl-ocaml-dev libcryptokit-ocaml-dev libgdbm-dev libsqlite3-ocaml-dev`

Распаковываем бота, заходим в директорию с sulci и собираем

`make`

Для работы бота потребуется словарь Mueller24.koi. Качаем его, например, [отсюда](http://vanoc.ru/files/Mueller24.tgz)

Директорию dict можно распаковать в папку с ботом, т.е. sulci.r318.src/sulci/

Затем переименуем файл sulci.conf.example в sulci.conf и настроим по своему усмотрению. Для того, чтоб бот запустился нужно не забыть изменить в sulci.conf путь до словаря /path/to/Mueller24.koi на dict/Mueller24.koi, т.е. указать именно тот путь путь куда поместили словарь.

Запускается бот так

`cd sulci<br />
./sulci`

Если бот не запустился, то открываем report.log и смотрим, что ему мешает.