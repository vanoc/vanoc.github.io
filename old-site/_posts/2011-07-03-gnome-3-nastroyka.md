---
id: 1187
title: Gnome 3 настройка
date: 2011-07-03T14:05:24+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1187
permalink: /runix/gnome-3-nastroyka/
categories:
  - arch
  - runix
tags:
  - gnome3
---
Не знаю что на меня нашло, но за последний месяц я перестанавливал систему большее число раз, чем за последние 3 года. В каждой что-то не устраивало. Тоже самое с оболочками. Наконец мне это все надоело и я остановился на арче с 3 гномом. Здесь небольшие заметки по настройке гнома.

Для на начала устанавливаем gnome-tweak-tool. Из него можно немного настроить оформление под себя.
  
Добавить кнопки свернуть, развернуть и т.д.

Затем можно установить плагины [GNOME Shell Extensions](http://www.fpmurphy.com/gnome-shell-extensions/) Закидывать их надо в ~/.local/share/gnome-shell/extensions Управлять ими можно из gnome-tweak-tool. Так же еще большая коллекция лежит в ауре.
  
`yaourt -Ss gnome-shell-extension`
  
Из мною используемых:

  * User Themes Extension
  * Gnote to Status Tray Extension (можно подправить для отображения иконок скайпа и пидгина в верхней панели)
  * Alternative Status Menu Extension
  * Pidgin IM Integration Extension
  * noa11y Extension
  * Weather indicator Extension

Теперь можно настроить курсор. Мне нравится КДЕ-шный курсор из Oxygen. Ставится из аура.
  
sudo yaourt -S oxygencursors-debian
  
Выбрать курсор можно в gnome-tweak-tool, но он применяется не ко всем приложениям. Исправить можно создав файл
  
`sudo touch /usr/share/icons/default/index.theme`
  
и прописав в него название выбранного курсора
  
`[Icon Theme]<br />
Inherits=name-of-cursor-theme`
  
У меня это Oxygen_Obsidian-hc.
  
Если курсор ставится ручками, то достаточно положить его в /usr/share/icons/
  
Далее перезагружаем оболочку (Alt+F2 –> r)

**Upd**: Разработчики таки создали сайт с плагинами <a href="https://extensions.gnome.org/" target="_blank">extensions.gnome.org</a> Достаточно зарегистрироваться и установка плагинов будет происходить одним движением мышки с OFF -> ON