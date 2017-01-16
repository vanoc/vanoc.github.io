---
id: 721
title: Запуск X приложений на удаленном компе через ssh
date: 2010-01-05T17:47:12+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=721
permalink: /ubuntu/zapusk-x-prilozhenij-na-udalennom-kompe-cherez-ssh/
dsq_thread_id:
  - "164630698"
categories:
  - runix
  - ubuntu
tags:
  - ssh
---
Дабы иметь возможность запускать приложения/сообщения на удаленном компе достаточно подключившись к нему выполнить
  
`export DISPLAY=:0.0`
  
либо дописывать к командам
  
`-display :0.0`

1. Чтобы на удаленном компе появилось сообщение, можно воспользоваться утилитой xmessage, правда у нее проблемы с кирилицей
  
`xmessage -center 'Vkljuchi skype'`
  
2. Так же можно воспользоваться wish
  
`echo 'button .b -text "Включи скайп" ; pack .b ' | wish`
  
По дефолту в ubuntu установлен tcl8.4. В принципе для того, чтобы привлечь внимание его хватает. Если вас не устраивают шрифты можно установить tcl8.5.
  
``sudo aptitude install tcl8.5 tk8.5<br />
sudo update-alternatives --config wish<br />
Есть 2 альтернатив, которые предоставляют `wish'.<br />
Выбор Альтернатива<br />
-----------------------------------------------<br />
*+ 1 /usr/bin/wish8.4<br />
2 /usr/bin/wish8.5<br />
Нажмите enter, чтобы сохранить значение по умолчанию[*], или введите выбранное число: 2<br />
Используется `/usr/bin/wish8.5' для предоставления `wish'.``
  
3. Создать текстовик и запустить
  
`echo 'Включи скайп' > file; gedit file`
  
4. Использовать libnotify
  
`sudo aptitude install libnotify-bin<br />
notify-send "Включи скайп, ночной красный гоблин"`

Вообще способов привлечь внимание много. Интересно узнать какие знаете Вы?