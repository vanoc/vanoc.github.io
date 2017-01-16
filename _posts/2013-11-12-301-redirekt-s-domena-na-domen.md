---
id: 1528
title: 301 редирект с домена на домен
date: 2013-11-12T12:01:03+00:00
author: vanoc
layout: post
guid: /?p=1528
permalink: /centos/301-redirekt-s-domena-na-domen/
categories:
  - centos
tags:
  - DNS
  - htaccess
  - nginx
---
Вчера столкнулся с таким интересным явлением, когда у совершенно стороннего чужого домена в качестве А записи в DNS с был указан ip нашего ресурса. Т.о. этот совершенно чужой домен показывал контент нашего портала и даже индексировался поисковиками. Для чего это было сделано не знаю, возможно ради повышения ТИЦ и PR своего домена.

Исправил это безобразие записью в .htaccess

<pre>Options +FollowSymLinks
RewriteEngine on
RewriteCond %{HTTP_HOST} чужойсайт.ru
RewriteRule ^(.*)$ http://нашсайт.ru/ [R=301,L]</pre>

В случае, если нужно сделать под nginx, тогда создаем конфиг файл, например, /etc/nginx/bx/site_enabled/redirect.conf (путь может быть другой, т.к. я делал для битрикса)

<pre>server {
        listen 80;
        server_name чужойсайт.ru www.чужойсайт.ru чужойсайт2.ru;
        rewrite ^ http://нашсайт.ru$request_uri? permanent;
}</pre>

затем

`service nginx configtest<br />
service nginx reload`