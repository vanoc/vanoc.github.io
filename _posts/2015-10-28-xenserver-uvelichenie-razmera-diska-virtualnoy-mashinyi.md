---
id: 1769
title: XenServer увеличение размера диска виртуальной машины
date: 2015-10-28T16:17:32+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1769
permalink: /centos/xenserver-uvelichenie-razmera-diska-virtualnoy-mashinyi/
categories:
  - centos
tags:
  - XenServer
---
<span style="color: #ff0000;"><strong>Делаем снапшот. В процессе он меня несколько раз спас.</strong></span>

По сути этот пост заметка на память, т.ч. ниже много копипаста с консоли.

Останавливаем виртуальную машину, увеличиваем размер диска в XenCenter и запускаем виртуалку.

Что имеем. В корне место почти закончилось.

<pre>% df -h
Файловая система        Размер Использовано  Дост Использовано% Cмонтировано в
/dev/mapper/centos-root   6,7G         6,7G  1,4M          100% /
devtmpfs                  909M            0  909M            0% /dev
tmpfs                     918M            0  918M            0% /dev/shm
tmpfs                     918M         8,3M  910M            1% /run
tmpfs                     918M            0  918M            0% /sys/fs/cgroup
/dev/xvda1                497M         216M  282M           44% /boot</pre>

<pre>% fdisk /dev/xvda
Welcome to fdisk (util-linux 2.23.2).

Changes will remain in memory only, until you decide to write them.
Be careful before using the write command.</pre>

<!--more-->Смотрим какие разделы есть

<pre>Команда (m для справки): p

Disk /dev/xvda: 21.5 GB, 21474836480 bytes, 41943040 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk label type: dos
Disk identifier: 0x00094419

Устр-во Загр Начало Конец Блоки Id Система
/dev/xvda1 * 2048 1026047 512000 83 Linux
/dev/xvda2 1026048 16777215 7875584 8e Linux LVM</pre>

Удаляем раздел /dev/xvda2 (данные останутся, в любом случае я сделал снапшот, а ты?)

<pre>Команда (m для справки): d
Номер раздела (1,2, default 2): 2
Partition 2 is deleted</pre>

Создаем новый раздел

<pre>Команда (m для справки): n
Partition type:
   p   primary (1 primary, 0 extended, 3 free)
   e   extended
Select (default p): p
Номер раздела (2-4, default 2): 2
Первый sector (1026048-41943039, по умолчанию 1026048): Enter
Используется значение по умолчанию 1026048
Last sector, +sectors or +size{K,M,G} (1026048-41943039, по умолчанию 41943039): Enter
Используется значение по умолчанию 41943039
Partition 2 of type Linux and of size 19,5 GiB is set</pre>

Что в итоге получилось?

<pre>Команда (m для справки): p

Disk /dev/xvda: 21.5 GB, 21474836480 bytes, 41943040 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk label type: dos
Disk identifier: 0x00094419

Устр-во Загр Начало Конец Блоки Id Система
/dev/xvda1 * 2048 1026047 512000 83 Linux
<span style="color: #ff0000;">/dev/xvda2 1026048 41943039 20458496 83 Linux</span></pre>

Нужно изменить тип раздела на LVM

<pre>Команда (m для справки): t
Номер раздела (1,2, default 2): 2
Hex code (type L to list all codes): 8e
Changed type of partition 'Linux' to 'Linux LVM'

Команда (m для справки): p

Disk /dev/xvda: 21.5 GB, 21474836480 bytes, 41943040 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk label type: dos
Disk identifier: 0x00094419

Устр-во Загр Начало Конец Блоки Id Система
/dev/xvda1 * 2048 1026047 512000 83 Linux
/dev/xvda2 1026048 41943039 20458496 <span style="color: #ff0000;">8e Linux LVM</span></pre>

Сохраняем изменения

<pre>Команда (m для справки): w
Таблица разделов была изменена!

Вызывается ioctl() для перечитывания таблицы разделов.

WARNING: Re-reading the partition table failed with error 16: Устройство или ресурс занято.
The kernel still uses the old table. The new table will be used at
the next reboot or after you run partprobe(8) or kpartx(8)
Синхронизируются диски.</pre>

Перезагружаем виртуальную машину.

Смотрим размер физического раздела (pv) LVM

<pre>% pvdisplay /dev/xvda2
  --- Physical volume ---
  PV Name               /dev/xvda2
  VG Name               centos
  PV Size              <span style="color: #ff0000;"> 7,51 GiB</span> / not usable 3,00 MiB
  Allocatable           yes (but full)
  PE Size               4,00 MiB
  Total PE              1922
  Free PE               0
  Allocated PE          1922
  PV UUID               Cxj7os-vJNg-ufJE-Ru25-mDSR-NLyv-kUxZLP</pre>

Изменяем его до нового размера диска

<pre>% pvresize /dev/xvda2 
  Physical volume "/dev/xvda2" changed
  1 physical volume(s) resized / 0 physical volume(s) not resized</pre>

<pre>% pvdisplay /dev/xvda2
  --- Physical volume ---
  PV Name               /dev/xvda2
  VG Name               centos
  PV Size               <span style="color: #ff0000;">19,51 GiB</span> / not usable 2,00 MiB
  Allocatable           yes 
  PE Size               4,00 MiB
  Total PE              4994
  Free PE               3072
  Allocated PE          1922
  PV UUID               Cxj7os-vJNg-ufJE-Ru25-mDSR-NLyv-kUxZLP</pre>

Смотрим какие есть логические разделы (lv) LVM

<pre>% lvdisplay 
  --- Logical volume ---
  LV Path                /dev/centos/swap
  LV Name                swap
  VG Name                centos
  LV UUID                d0itkO-hZNO-m3ru-isby-WOo3-6DxI-H9F5Rf
  LV Write Access        read/write
  LV Creation host, time localhost, 2014-12-23 15:49:59 +0300
  LV Status              available
  # open                 2
  LV Size                820,00 MiB
  Current LE             205
  Segments               1
  Allocation             inherit
  Read ahead sectors     auto
  - currently set to     8192
  Block device           253:0
   
  --- Logical volume ---
  LV Path                /dev/centos/root
  LV Name                root
  VG Name                centos
  LV UUID                vcFrzl-uXf8-sCJC-0OTl-vAQZ-DCns-1Wykm3
  LV Write Access        read/write
  LV Creation host, time localhost, 2014-12-23 15:49:59 +0300
  LV Status              available
  # open                 1
  LV Size                6,71 GiB
  Current LE             1717
  Segments               1
  Allocation             inherit
  Read ahead sectors     auto
  - currently set to     8192
  Block device           253:1</pre>

Мне нужен /dev/centos/root

Здесь я экспериментировал с &#171;lvextend -l 100%FREE /dev/centos/root&#187; но эта команда почему-то увеличила размер раздела не на все свободное место, потом через &#171;lvextend -L +1G /dev/centos/root&#187; добавил еще 1 гиг. В итоге размер увеличился 13,8 G, что собственно видно в vgdisplay.

Смотрим сколько свободного места имеем

<pre>% vgdisplay 
  --- Volume group ---
  VG Name               centos
  System ID             
  Format                lvm2
  Metadata Areas        1
  Metadata Sequence No  6
  VG Access             read/write
  VG Status             resizable
  MAX LV                0
  Cur LV                2
  Open LV               2
  Max PV                0
  Cur PV                1
  Act PV                1
  VG Size               19,51 GiB
  PE Size               4,00 MiB
  Total PE              4994
  Alloc PE / Size       3533 / 13,80 GiB
  <span style="color: #ff0000;">Free  PE / Size       1461 / 5,71 GiB</span>
  VG UUID               k6HEZj-kytY-01xn-wpuo-L09C-jQS7-YMeVdk</pre>

Увеличиваем раздел

<pre>% lvextend -L +5.70G /dev/centos/root
  Rounding size to boundary between physical extents: 5,70 GiB
  Size of logical volume centos/root changed from 13,00 GiB (3328 extents) to 18,70 GiB (4788 extents).
  Logical volume root successfully resized</pre>

В случае, если используется файловая система ext2/3/4, выполняем

<pre>% resize2fs /dev/centos/root 
resize2fs 1.42.9 (28-Dec-2013)
resize2fs: Bad magic number in super-block while trying to open /dev/centos/root
Couldn't find valid filesystem superblock.</pre>

Однако, оказалось, что у меня xfs :)

`% mount | grep centos-root<br />
/dev/mapper/centos-root on / type <span style="color: #ff0000;">xfs</span> (rw,relatime,attr2,inode64,noquota)`

Изменяем размер

<pre>% xfs_growfs /dev/mapper/centos-root 
meta-data=/dev/mapper/centos-root isize=256    agcount=4, agsize=439552 blks
         =                       sectsz=512   attr=2, projid32bit=1
         =                       crc=0        finobt=0
data     =                       bsize=4096   blocks=1758208, imaxpct=25
         =                       sunit=0      swidth=0 blks
naming   =version 2              bsize=4096   ascii-ci=0 ftype=0
log      =internal               bsize=4096   blocks=2560, version=2
         =                       sectsz=512   sunit=0 blks, lazy-count=1
realtime =none                   extsz=4096   blocks=0, rtextents=0
data blocks changed from 1758208 to 4902912</pre>

Готово

<pre>% df -h
Файловая система        Размер Использовано  Дост Использовано% Cмонтировано в
/dev/mapper/centos-root    <span style="color: #ff0000;">19G</span>         6,7G   12G           36% /
devtmpfs                  909M            0  909M            0% /dev
tmpfs                     918M            0  918M            0% /dev/shm
tmpfs                     918M         8,3M  910M            1% /run
tmpfs                     918M            0  918M            0% /sys/fs/cgroup
/dev/xvda1                497M         216M  282M           44% /boot</pre>

Спасибо <a href="https://mtaalamu.ru/blog/admining/2265.html" target="_blank">mtaalamu.ru</a> и <a href="http://www.systemadmin.me.uk/?p=434" target="_blank">systemadmin.me.uk</a>