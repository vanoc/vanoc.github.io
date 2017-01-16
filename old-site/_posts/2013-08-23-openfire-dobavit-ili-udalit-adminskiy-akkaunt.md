---
id: 1492
title: openfire добавить или удалить админский аккаунт
date: 2013-08-23T15:57:08+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1492
permalink: /linux/openfire-dobavit-ili-udalit-adminskiy-akkaunt/
categories:
  - linux
tags:
  - jabber
  - openfire
---
Так получилось, что на новой работе, ввиду того, что админы с какой-то периодичностью сменялись, оказался сервер с древним openfire, от которого никто не знал пароль. Работает, ну и пусть себе дальше работает. А у меня же руки чешутся, вот и решил поиметь таки на него доступ.
  
Все оказалось не очень сложно.

Открываем конфиг файл (аккуратно, кто не знаком с vim, может использовать nano)
  
`vim /opt/openfire/conf/openfire.xml`
  
добавляем выделенные **жирным** строки

`<!-- root element, all properties must be under this element --><br />
<jive><br />
<strong><admin></strong><br />
<strong> <authorizedJIDs>admin@example.com, new@example.com</authorizedJIDs></strong><br />
<strong> </admin></strong><br />
<adminConsole><br />
<!-- Disable either port by setting the value to -1 --><br />
<port>9090</port><br />
<securePort>9091</securePort><br />
</adminConsole><br />
` 

Перезапускаем openfire
  
`service openfire restart`