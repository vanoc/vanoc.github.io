---
id: 1591
title: Автозапуск виртуальной машины в Citrix XenServer 6.2
date: 2014-03-03T15:05:35+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1591
permalink: /linux/avtozapusk-virtualnoy-mashinyi-v-citrix-xenserver-6-2/
categories:
  - linux
tags:
  - Xen
---
Кратенько. Для 6 версии из XenCenter настроить автозапуск уже не получится, однако можно сделать из консоли.

Для начала добавляем эту возможность для пула. 

<pre># xe pool-list
uuid ( RO)                : ...
# xe pool-param-set uuid=... other-config:auto_poweron=true</pre>

Теперь для виртуалок, которым требуется автозапуск.

Список виртуальных машин с uuid-ами
  
`# xe vm-list`
  
Включаем автозапуск
  
`# xe vm-param-set  uuid=... other-config:auto_poweron=true`
  
Проверяем
  
`# xe vm-param-list uuid=... | grep auto_poweron`
  
Ищем auto_poweron, должно быть что-то вроде:
  
`other-config (MRW): auto_poweron: true; ...`

Выключаем автозапуск
  
`# xe vm-param-set  uuid=... other-config:auto_poweron=false`