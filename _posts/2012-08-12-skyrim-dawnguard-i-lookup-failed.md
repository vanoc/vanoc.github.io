---
id: 1352
title: Skyrim, Dawnguard и LOOKUP FAILED!
date: 2012-08-12T09:47:27+00:00
author: vanoc
layout: post
guid: /?p=1352
permalink: /games/skyrim-dawnguard-i-lookup-failed/
categories:
  - игры
tags:
  - The Elder Scrolls
---
С выходом Dawnguard решил поиграть заново в The Elder Scrolls V: Skyrim, однако косяки перевода чуть не убили желание играть. В следствие чего было найдено решение проблемы LOOKUP FAILED!

[<img class="aligncenter size-medium wp-image-1353" title="Skyrim String Localizer" src="/uploads/2012/08/Skyrim_String_Localizer-300x239.png" alt="" width="300" height="239" srcset="/uploads/2012/08/Skyrim_String_Localizer-300x239.png 300w, /uploads/2012/08/Skyrim_String_Localizer.png 768w" sizes="(max-width: 300px) 100vw, 300px" />](/uploads/2012/08/Skyrim_String_Localizer.png)
  
Делаем копию директории The Elder Scrolls V Skyrim\Data\Strings\ (на всякий случай) Качаем и запускаем [Skyrim String Localizer](/uploads/2012/08/Skyrim_String_Localizer_v139-2889-1-3-9.rar). В строке ESP File указываем The Elder Scrolls V Skyrim\Data\Update.esm, в строке Strins File: The Elder Scrolls V Skyrim\Data\Strings\Update\_Russian.STRINGS и жмем Process. Программа загрузит перевод, там где пустые строки это и есть наш LOOKUP FAILED! В процессе программа попросит указать файл, в котором есть недостающий перевод. Укажем Skyrim\_Russian.STRINGS. Пустые ранее строки заполнятся переводом и выделятся зеленым цветом. Остается только нажать Write Strings и переписать файлы. Теперь можно запускать Skyrim и наслаждаться игрой.