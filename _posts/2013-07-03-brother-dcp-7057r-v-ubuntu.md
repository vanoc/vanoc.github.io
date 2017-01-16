---
id: 1477
title: Brother DCP-7057R в ubuntu
date: 2013-07-03T11:00:05+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1477
permalink: /ubuntu/brother-dcp-7057r-v-ubuntu/
categories:
  - ubuntu
tags:
  - brother
---
МФУ настраивает очень легко, благо драйвера для принтера и сканера выложены на <a href="http://welcome.solutions.brother.com/bsc/public_s/id/linux/en/index.html" target="_blank">официальном сайте</a>.

Единственная проблема может возникнуть с запуском программы сканирования. В принципе решение описано <a href="http://welcome.solutions.brother.com/bsc/public_s/id/linux/en/instruction_scn1c.html" target="_blank">там же</a>.

Кратко.
  
Жмем в консоли
  
`$ lsusb<br />
Bus 001 Device 002: ID <strong>04f9</strong>:<strong>0273</strong> Brother Industries, Ltd`
  
Открываем файл файл _/lib/udev/rules.d/40-libsane.rules_ и вписываем
  
`# brother dcp-7057r<br />
ATTRS{idVendor}=="<strong>04f9</strong>", ATTRS{idProduct}=="<strong>0273</strong>", ENV{libsane_matched}="yes"`
  
затем
  
`$ udevadm control --reload`
  
или перезагружаемся.