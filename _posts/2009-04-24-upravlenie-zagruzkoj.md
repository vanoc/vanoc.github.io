---
id: 476
title: Управление автозагрузкой
date: 2009-04-24T20:32:36+00:00
author: vanoc
layout: post
guid: /?p=476
permalink: /ubuntu/upravlenie-zagruzkoj/
ljID:
  - "274"
ljxp_comments:
  - "0"
ljxp_privacy:
  - "0"
dsq_thread_id:
  - "164630608"
categories:
  - runix
  - ubuntu
tags:
  - rcconf
  - sysv-rc-conf
  - update-rc.d
---
На данный момент мне известны три терминальные утилиты для работы с автозагрузкой в убунту. Это rcconf, sysv-rc-conf и update-rc.d

**rcconf**
  
[<img src="/uploads/2009/04/vanoc@vanoc-pc--300x186.png" alt="" title="rcconf" width="300" height="186" class="alignnone size-medium wp-image-736" srcset="/uploads/2009/04/vanoc@vanoc-pc--300x186.png 300w, /uploads/2009/04/vanoc@vanoc-pc-.png 660w" sizes="(max-width: 300px) 100vw, 300px" />](/uploads/2009/04/vanoc@vanoc-pc-.png)
  
Самая простая утилита. Пробелом выбираем чему загружаться, а чему нет. 

**update-rc.d**
  
Отключаем запуск bluetooth при загрузке
  
`vanoc@laptop:~$ sudo update-rc.d -f bluetooth remove<br />
[sudo] password for vanoc:<br />
Removing any system startup links for /etc/init.d/bluetooth ...<br />
/etc/rc0.d/K74bluetooth<br />
/etc/rc1.d/K74bluetooth<br />
/etc/rc2.d/K74bluetooth<br />
/etc/rc3.d/K74bluetooth<br />
/etc/rc4.d/K74bluetooth<br />
/etc/rc5.d/K74bluetooth<br />
/etc/rc6.d/K74bluetooth<br />
vanoc@laptop:~$`

Включаем запуск bluetooth
  
`vanoc@laptop:~$ sudo update-rc.d -f bluetooth defaults<br />
Adding system startup for /etc/init.d/bluetooth ...<br />
/etc/rc0.d/K20bluetooth -> ../init.d/bluetooth<br />
/etc/rc1.d/K20bluetooth -> ../init.d/bluetooth<br />
/etc/rc6.d/K20bluetooth -> ../init.d/bluetooth<br />
/etc/rc2.d/S20bluetooth -> ../init.d/bluetooth<br />
/etc/rc3.d/S20bluetooth -> ../init.d/bluetooth<br />
/etc/rc4.d/S20bluetooth -> ../init.d/bluetooth<br />
/etc/rc5.d/S20bluetooth -> ../init.d/bluetooth<br />
vanoc@laptop:~$`

**sysv-rc-conf**
  
[<img class="alignnone size-medium wp-image-477" title="sysv-rc-conf" src="/uploads/sysv-rc-conf-300x212.png" alt="sysv-rc-conf" width="300" height="212" srcset="/uploads/sysv-rc-conf-300x212.png 300w, /uploads/sysv-rc-conf.png 663w" sizes="(max-width: 300px) 100vw, 300px" />](/uploads/sysv-rc-conf.png)
  
Достаточно убрать пробелом крестики и выбранный процесс грузиться не будет. -/+ остановка/запуск процесса. q &#8212; выход.

P.S. Прошу не судить строго, я не сисадмин, а простой бухгалтер, у которого зудит в одном месте и тянет разобраться, что же такое линукс, на примере ubuntu.