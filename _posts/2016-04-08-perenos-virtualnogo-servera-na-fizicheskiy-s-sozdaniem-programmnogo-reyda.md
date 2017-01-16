---
id: 1807
title: Перенос виртуального сервера на физический с созданием программного рейда
date: 2016-04-08T11:15:19+00:00
author: vanoc
layout: post
guid: /?p=1807
permalink: /centos/perenos-virtualnogo-servera-na-fizicheskiy-s-sozdaniem-programmnogo-reyda/
categories:
  - centos
tags:
  - XenServer
---
Задача: перести виртуальный почтовый сервер на физический с созданием RAID 1 (зеркало).

Имеется виртуалка на XenServer и физический сервер с двумя винтами по 1 Тб

Установим Centos minimal на один из винтов и поделим диск на разделы

<pre>/dev/sda1 /boot
/dev/sda2 swap
/dev/sda3 /</pre>

Теперь установим mdadm и vim (обожаю этот текстовый редактор)

<pre>yum install mdadm vim</pre>

Теперь надо подготовить второй диск для настройки на нем рейда. Скопируем схему разбивки диска с /dev/sda

<pre>sfdisk -d /dev/sda | sfdisk /dev/sdb</pre>

Что получилась можно посмотреть командой fdisk -l

Теперь сменим тип разделов /dev/sdb на «Linux raid autodetect» Для этого выполняем

<pre>fdisk /dev/sdb</pre>

жмем &#8216;t&#8217;, затем &#8216;1&#8217; (первый раздел диска), затем &#8216;fd&#8217;
  
Повторяем все заново для каждого из разделов.
  
Сохраняем изменения &#8216;w&#8217;

<!--more-->В итоге смотрим что получилось уже знакомой командой

<pre>fdisk -l</pre>

Диск /dev/sdb готов. Можно на нем создать деградированный рейд, т.к. пока будем использовать только один диск.

<pre>mdadm --create /dev/md0 --level=1 --raid-devices=2 missing /dev/sdb1
mdadm --create /dev/md1 --level=1 --raid-devices=2 missing /dev/sdb2
mdadm --create /dev/md2 --level=1 --raid-devices=2 missing /dev/sdb3</pre>

Смотрим что получилось

<pre>cat /proc/mdstat</pre>

Отлично. Теперь создадим файловую систему.

<pre>mkfs.ext4 /dev/md0
mkswap /dev/md1
mkfs.ext4 /dev/md2</pre>

Следующим этапом будем переносить данные с виртуальной машины.
  
Для начала монтируем разделы

<pre>mount /dev/md2 /mnt
mkdir /mnt/boot
mount /dev/md0 /mnt/boot</pre>

Остается скопировать файлы виртуальный машины на физическую

<pre>rsync -av --exclude=/dev/* --exclude=/proc/* --exclude=/sys/* --exclude=/tmp/* --exclude=/mnt/* /* /mnt</pre>

Теперь подготовим систему для chroot

<pre>mount --bind /proc /mnt/proc
mount --bind /dev /mnt/dev
mount --bind /sys /mnt/sys
mount --bind /run /mnt/run</pre>

Собственно заходим

<pre>chroot /mnt/</pre>

Первым делом надо подготовить fstab

<pre>blkid /dev/md*
/dev/md0: UUID="your-UUID" TYPE="ext4"
/dev/md1: UUID="your-UUID" TYPE="swap"
/dev/md2: UUID="your-UUID" TYPE="ext4"</pre>

<pre>vim /etc/fstab
UUID=your-UUID / ext4 defaults 1 1
UUID=your-UUID /boot ext4 defaults 1 1
UUID=your-UUID swap swap defaults 0 0</pre>

Создадним конфиг файл mdadm

<pre>mdadm --detail --scan > /etc/mdadm.conf</pre>

Подготовим initramfs. Здесь могут быть два варианта:

1. у вас системы, виртуальная и та, с которой вы загрузились, обновлены и у них одно и то же ядро. Тогда можно выполнить

<pre>cp /boot/initramfs-$(uname -r).img /boot/initramfs-$(uname -r).img.bck
dracut --mdadmconf --fstab --add="mdraid" --filesystems "xfs ext4 ext3 tmpfs devpts sysfs proc" \
--add-drivers="raid1" --force /boot/initramfs-$(uname -r).img $(uname -r) -M</pre>

2. boot у систем различный. Нам нужно перетащить boot с виртуалки. Поэтому на действующей виртуальной машине смотрим &#171;uname -r&#187; и подставляем в предыдущую команду вместо $(uname -r)

Теперь подправим grub

<pre>vim /etc/default/grub
GRUB_CMDLINE_LINUX="rd.auto rd.auto=1 rhgb quiet"
GRUB_PRELOAD_MODULES="mdraid1x"</pre>

и создадим новый grub.cfg

<pre>grub2-mkconfig -o /boot/grub2/grub.cfg</pre>

Устанавливаем

<pre>grub2-install /dev/sdb</pre>

Перезагружаемся. Нам надо загрузиться с /dev/sdb, поэтому смотрим в биосе с какого диска загружаться.

Та-даам. Если вы таки смогли загрузиться, а у меня получилось с первого раза, то я вас поздравляю.

Теперь проверяем.
  
Подключен ли swap

<pre>swapon -s
Filename Type Size Used Priority
/dev/md1 partition 12279804 0 -1</pre>

Смонтированы ли остальные разделы

<pre>mount -t ext4
/dev/md2 on / type ext4 (rw,relatime,data=ordered)
/dev/md0 on /boot type ext4 (rw,relatime,data=ordered)</pre>

Смотрим состояние рейда

<pre>cat /proc/mdstat</pre>

Осталось всего ничего. Подготовить /dev/sda и добавить в рейд

Сменим тип разделов /dev/sda на «Linux raid autodetect» Для этого выполняем

<pre>fdisk /dev/sda</pre>

жмем &#8216;t&#8217;, затем &#8216;1&#8217; (первый раздел диска), затем &#8216;fd&#8217;
  
Повторяем все заново для каждого из разделов.
  
Не забываем сохранить изменения &#8216;w&#8217;

Подключаем в рейд

<pre>mdadm --manage /dev/md0 --add /dev/sda1
mdadm --manage /dev/md1 --add /dev/sda2
mdadm --manage /dev/md2 --add /dev/sda3</pre>

Следим за ребилдом

<pre>watch "cat /proc/mdstat"</pre>

Установим grub на /dev/sda

<pre>grub2-install /dev/sda</pre>

Собственно на этом все.

Можно добавить в mdamd.conf уведомление руту

<pre>vim /etc/mdadm.conf
MAILADDR root</pre>

И в /etc/aliases указываем куда отправлять

<pre>root= мой@емэйл.ру</pre>

Обновляем алиасы

<pre>newaliases</pre>

Спасибо <a href="http://www.cmatthew.net/wiki/Convert_to_raid_1_CentOS_7" target="_blank">cmatthew.net</a>