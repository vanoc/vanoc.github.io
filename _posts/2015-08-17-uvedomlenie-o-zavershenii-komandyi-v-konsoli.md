---
id: 1754
title: Уведомление о завершении команды в консоли
date: 2015-08-17T21:50:46+00:00
author: vanoc
layout: post
guid: /?p=1754
permalink: /linux/uvedomlenie-o-zavershenii-komandyi-v-konsoli/
categories:
  - linux
tags:
  - zsh
---
Скрипт для zsh позволяющий вывести уведомление о завершений команды, если терминал не открыт и команда выполнялась больше 10 секунд.

<pre>function active-window-id {
echo `xprop -root | awk '/_NET_ACTIVE_WINDOW\(WINDOW\)/{print $NF}'`
}

# end and compare timer, notify-send if needed
function notifyosd-precmd() {
if [ ! -z "$cmd" ]; then
cmd_end=`date +%s`
((cmd_time=$cmd_end - $cmd_start))
fi
if [ ! -z "$cmd" -a $cmd_time -gt 10 -a "$window_id_before" != "$(active-window-id)" ]; then
kdialog --title "$cmd_basename completed" --passivepopup "\"$cmd\" took $cmd_time seconds"
unset cmd
fi
}

# make sure this plays nicely with any existing precmd
precmd_functions+=( notifyosd-precmd )

# get command name and start the timer
function notifyosd-preexec() {
window_id_before=$(active-window-id)
cmd=$1
cmd_basename=${cmd[(ws: :)1]}
cmd_start=`date +%s`
}

# make sure this plays nicely with any existing preexec
preexec_functions+=( notifyosd-preexec )</pre>

Скрипт для КДЕ, т.к. используется kdialog для вывода уведомления. Оригинал на <a href="https://gist.github.com/shockone/5255331" target="_blank">гитхабе</a>. Там же для гнома.

Код сохраняем в файл .notifyosd.zsh и добавляем в .zshrc строку

`[ -e ~/.notifyosd.zsh ] && . ~/.notifyosd.zsh`