---
id: 1169
title: apt и proxy
date: 2011-05-13T14:13:16+00:00
author: vanoc
layout: post
guid: http://vanoc.ru/?p=1169
permalink: /ubuntu/apt-i-proxy/
categories:
  - runix
  - ubuntu
tags:
  - apt
  - bashrc
  - proxy
---
Чтоб apt смог юзать инет через проксю прописываем в /etc/apt/apt.conf
  
`Acquire::http::Proxy "http://домен\логин:пароль@ip:порт";<br />
Acquire::https::Proxy "http://домен\логин:пароль@ip:порт";<br />
Acquire::ftp::Proxy "http://домен\логин:пароль@ip:порт";`

Так же можно прописать в .bashrc
  
`export http_proxy=http://домен\\логин:пароль@ip:порт;<br />
export ftp_proxy=http://домен\\логин:пароль@ip:порт;`