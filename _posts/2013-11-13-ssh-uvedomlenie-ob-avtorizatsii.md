---
id: 1533
title: SSH уведомление об авторизации
date: 2013-11-13T14:22:06+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1533
permalink: /linux/ssh-uvedomlenie-ob-avtorizatsii/
categories:
  - linux
tags:
  - python
  - ssh
---
Решил реализовать уведомление на почту о том, что кто-то авторизовался в ssh. Сперва решение выглядело вот так:

`echo -e "Remote connection from\t $SSH_CONNECTION \nLogin $USER" | /bin/mail -s "[SSH] Login on $(hostname)" мояпочта@сайт.ru`

Добавляем эту строку в /etc/ssh/sshrc (в случае, если этого файла нет, а его скорее всего не будет, его следует создать)

У этого решения есть существенный недостаток &#8212; письма будут отсылаться после любой аутентификации по ssh. Даже если это вы залогинились, письмо все равно вам придет. Дабы не получать массу писем и ввиду того, что я начал изучать python, решил попробовать написать на нем. Получился скрипт сравнивающий с нашего ли ip залогинились, в противном случае шлет email на указанную почту.

<pre>#!/usr/bin/env python

import smtplib, os, platform
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText

server = smtplib.SMTP('smtp.сайт.ru', 25)

sender = 'root@'+platform.node()
to = 'мояпочта@сайт.ru'

ip = 'xxx.xxx.xxx.xxx'
sship = os.environ['SSH_CONNECTION']
loginname = os.environ['LOGNAME']

msg = MIMEMultipart()
msg['Subject'] = '[SSH] Login on ' + platform.node()
msg['From'] = sender
msg['To'] = to
text = 'Remote connection from\t' + sship + '\nLogin ' + loginname
msg.attach (MIMEText(text, 'plain'))

textmail = msg.as_string()

if ip in sship:
        print ('hi. Welcome!')
else:
        print ('who is it?')
        server.sendmail(sender, to, textmail)</pre>

Сохраняем скрипт в файл, например, noticessh.py и прописываем путь к нему в /etc/ssh/sshrc. К сожалению не со всеми версиями второго питона работает, так же мешает авторизовываться по sftp в случае, если sftp работает через ssh. FileZilla, например, ругается &#171;Оut of memory!&#187; Надо бы допилить, но на данный момент к сожалению знаний по питону не достаточно.