---
id: 1695
title: Outlook Не удается создать файл
date: 2014-09-05T12:44:49+00:00
author: vanoc
layout: post
guid: /?p=1695
permalink: /windows/outlook-ne-udaetsya-sozdat-fayl/
categories:
  - windows
tags:
  - Outlook
---
[<img class="aligncenter size-medium wp-image-1696" src="/uploads/2014/09/outlook-300x39.png" alt="outlook" width="300" height="39" />](/uploads/2014/09/outlook.png)

Проблема во временных файлах, а именно в том, что они не удаляются автоматически. В связи с этим есть забавный баг (а может это фича :) Outlook не может открыть файл письма, если уже приходили письма с файлами имеющими такое же название больше 99 раз (вернее, если эти файлы открывались) Все последующие файлы с подобным именем открываться и сохраняться не будут.

Лечится так. Заходим в реестр:
  
`HKEY_CURRENT_USER\Software\Microsoft\Office\НОМЕР_ВЕРСИИ\Outlook\Security`
  
Сморим путь указанный в OutlookSecureTempFolder и удаляем все содержимое данной директории.