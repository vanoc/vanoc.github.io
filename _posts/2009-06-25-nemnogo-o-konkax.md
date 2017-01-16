---
id: 480
title: Немного о коньках
date: 2009-06-25T13:24:28+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=480
permalink: /ubuntu/nemnogo-o-konkax/
ljID:
  - "276"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630642"
categories:
  - runix
  - ubuntu
tags:
  - conky
  - hddtemp
  - sensors
---
<img class="alignnone size-full wp-image-492" title="conky" src="http://vanoc.ru/uploads/2009/06/conky.png" alt="conky" width="263" height="258" />

На данный момент от conky мне нужно не много. Ниже что и как делал.

Для начала установил нужные пакеты. hddtemp спросит загружаться ли автоматически укажем &#8212; да.

`sudo aptitude install conky hddtemp lm-sensors`

Затем запустил от рута **sensors-detect** для поиска средств мониторинга. Со всеми вопросами соглашаемся. Do you want to add these lines to /etc/modules automatically? (yes/NO) тоже yes.

Перезагрузим модули ядра

`sudo /etc/init.d/module-init-tools start`

Теперь командой **sensors** можно осуществлять мониторинг системы.

Затем нужно немного отредактировать конфиг hddtemp

`sudo gedit /etc/default/hddtemp`

Изменил на RUN_DAEMON=&#187;**true**&#187; и DISKS=&#187;/dev/**sda**&#187; Не забудьте расскомментировать (убрать #)

Затем запускаем демона, если он еще не запущен

`sudo /etc/init.d/hddtemp start`

Для запуска conky потребуется создать файл настроек в домашней директории. Вот мой файл [.conkyrc](http://vanoc.ru/uploads/.conkyrc).

Температура ядер выводится строками

`CPUtemp 1 ${alignr}${execi 10 sensors coretemp-isa-0000 | grep '+' | cut -b15-16}°C<br />
CPUtemp 2 ${alignr}${execi 10 sensors coretemp-isa-0001 | grep '+' | cut -b15-16}°C`

coretemp-isa-0000 и coretemp-isa-0001 я взял из того, что мне выдал **sensors**

`$ sensors<br />
acpitz-virtual-0<br />
Adapter: Virtual device<br />
temp1:       +60.0°C  (crit = +90.0°C)<br />
coretemp-isa-0000<br />
Adapter: ISA adapter<br />
Core 0:      +58.0°C  (high = +85.0°C, crit = +85.0°C)<br />
coretemp-isa-0001<br />
Adapter: ISA adapter<br />
Core 1:      +58.0°C  (high = +85.0°C, crit = +85.0°C)`

Температура жесткого диска выводится командой

`HDDtemp: ${alignr}${execi 10 netcat localhost 7634 | cut --delimiter '|' --fields 4}°C`

где с помощью параметров команды cut -d (&#8212;delimiter) можно задать разделитель полей, а с -f (&#8212;fields) указать нужное нам поле.

Для автоматического запуска conky можно добавить его в &#171;Система &#8212; Параметры &#8212; Запускаемые приложения&#187;

upd: Спасибо [Minoru](http://debiania.blogspot.com/) за подсказку с cut.