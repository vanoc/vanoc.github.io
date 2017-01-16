---
id: 1840
title: centos 7 + openfire 4.0.2 + SSO
date: 2016-07-26T18:32:23+00:00
author: vanoc
layout: post
guid: /?p=1840
permalink: /centos/centos-7-openfire-4-0-2-sso/
categories:
  - centos
tags:
  - openfire
  - SSO
---
Заметка на память как заставить openfire работать с SSO

Качаем openfire и устанавливаем

`wget http://download.igniterealtime.org/openfire/openfire-4.0.2-1.i386.rpm<br />
yum install ~/openfire-4.0.2-1.i386.rpm`

Ставим mysql
  
`yum install mariadb mariadb-server libldb.i686 krb5-workstation`

Добавляем в автозагрузку и запускаем mysql и openfire

`systemctl enable mariadb.service<br />
systemctl start mariadb.service<br />
systemctl enable openfire.service<br />
systemctl start openfire.service`

Создаем базу данных

`mysql<br />
> CREATE DАТАBASE openfire;<br />
> GRANT ALL on openfire.* to 'openfire'@localhost IDENTIFIED BY 'your password';<br />
> FLUSH PRIVILEGES;`<!--more-->

\# полезная заметка с <a href="http://achlab.ru/ach/2011/08/24/openfire-знаки-вопроса-в-именах-контактов-и-г/" target="_blank">http://achlab.ru/ach/2011/08/24/openfire-знаки-вопроса-в-именах-контактов-и-г/</a>

меняем кодировку на utf8

`> use openfire;<br />
> alter database character set utf8;<br />
> alter database collate utf8_general_ci;`

Во время установки, когда будете выбирать драйвер MySQL укажите URL к базе вида:
  
**`jdbc:mysql://localhost:3306/openfire?useUnicode=true&characterEncoding=UTF-8&characterSetResults=UTF-8`**

Если openfire уже установлен, то переконвертируйте базу в utf8, затем файле конфигурации openfire.xml допишите после jdbc:mysql://localhost:3306/openfire

**`?useUnicode=true&amp;characterEncoding=UTF-8&amp;characterSetResults=UTF-8`**

Здесь нужно **ОБЯЗАТЕЛЬНО!** заменить **&** на **&** иначе вместо входа в админку увидите страницу установки openfire.

\# конец заметки

Открываем в браузере http://my_ip:9090/
  
my_ip меняем на ip адрес сервера

В процессе указываем использовать mysql базу, LDAP и прочее.

<pre>DC="realm",DC="local" </pre>

С настройкой openfire почти закончено.

Настраиваем SSO

`mv /etc/krb5.conf /etc/krb5.conf.bac<br />
vim /etc/krb5.conf`

Приводим файл к виду

<pre>[logging]
 default = FILE:/var/log/krb5libs.log
 kdc = FILE:/var/log/krb5kdc.log
 admin_server = FILE:/var/log/kadmind.log

[libdefaults]
        default_realm = REALM.LOCAL
        kdc_timesync = 1
        forwardable = true
        proxiable = true
        default_tkt_enctypes = rc4-hmac des3-cbc-sha1 des-cbc-crc des-cbc-md5
        default_tgs_enctypes = rc4-hmac des3-cbc-sha1 des-cbc-crc des-cbc-md5
        permitted_enctypes = rc4-hmac des3-cbc-sha1 des-cbc-crc des-cbc-md5
[realms]
        REALM.LOCAL = {
                kdc = realm.local
                admin_server = realm.local
                default_domain = REALM.LOCAL
        }
[domain_realm]
        .realm.local = REALM.LOCAL
        realm.local = REALM.LOCAL</pre>

Создадим gss.conf файл

`vim /opt/openfire/conf/gss.conf`

<pre>com.sun.security.jgss.accept {
    com.sun.security.auth.module.Krb5LoginModule
    required
    storeKey=true
    keyTab="/opt/openfire/xmpp.keytab"
    doNotPrompt=true
    useKeyTab=true
    realm="REALM.LOCAL"
    principal="xmpp/openfireserver.realm.local@REALM.LOCAL"
    isInitiator=false
    debug=true;
};</pre>

Создадим xmpp.keytab файл. Для этого заходим на контроллер домена.
  
Создаем учетку с любым именем, допустим xmpp-openfire, с вечным паролем и включенной опцией «Do not require Kerberos preauthentication» (Без предварительной проверки подлинности Kerberos)

Создаем SPN и связываем ее с учеткой xmpp-openfire

<pre>> setspn -A xmpp/openfireserver.realm.local@REALM.LOCAL xmpp-openfire
> ktpass -princ xmpp/openfireserver.realm.local@REALM.LOCAL -mapuser xmpp-openfire@realm.local -pass your_password -ptype KRB5_NT_PRINCIPAL</pre>

меняем your_password на пароль ранее созданной учетки.

Пришло время создать keytab файл.

<pre>> ktpass -princ xmpp/openfireserver.realm.local@REALM.LOCAL -mapuser xmpp-openfire@realm.local -pass your_password -ptype KRB5_NT_PRINCIPAL -out xmpp.keytab</pre>

xmpp.keytab будет лежать в C:\Documents and Settings\Administrator

забираем его и переносим на настраиваемый openfire сервер в /opt/openfire/
  
Путь должен совпадать с тем, что мы указали в gss.conf файле

Выставляем права на ключ
  
`chown daemon:daemon /opt/openfire/conf/gss.conf<br />
chown daemon:daemon /opt/openfire/xmpp.keytab<br />
chmod 440 /opt/openfire/xmpp.keytab`

Проверим ключ.

<pre>kinit -V -k -t /opt/openfire/xmpp.keytab xmpp/openfireserver.realm.local@REALM.LOCAL</pre>

ответ должен быть
  
Authenticated to Kerberos v5

Если все хорошо, то осталось совсем немного. Заходим браузером в консоль администратора Openfire и в разделе System properties и по одному добавляем параметры:

`sasl.gssapi.config = /opt/openfire/conf/gss.conf<br />
sasl.gssapi.debug = false<br />
sasl.gssapi.useSubjectCredsOnly = false<br />
sasl.mechs = GSSAPI<br />
sasl.realm = REALM.LOCAL<br />
xmpp.fqdn = openfireserver.realm.local`

Перезапускаем openfire

`systemctl restart openfire.service`

На пользовательском компьютере правим реестр
  
HKEY\_LOCAL\_MACHINE\System\CurrentControlSet\Control\Lsa\Kerberos\Parameters
  
(For XP: HKEY\_LOCAL\_MACHINE\System\CurrentControlSet\Control\Lsa\Kerberos)
  
добавляем параметр типа DWORD
  
AllowTGTSessionKey со значением 1.

Пеперезапускаем рабочую станцию.

Я использовал Spark, в нем выбираем опцию «Use Single Sign-On (SSO) via GSSAPI»

Собственно все.

Ошибки с которыми мне пришлось столкнуться в основном связаны с ключом и дублированием записей на контроллере домена.

Первая ошибка.

При попытке проверить ключ получал ответ

<pre>kinit -V -k -t /opt/openfire/xmpp.keytab xmpp/openfireserver.realm.local@REALM.LOCAL
Using default cache: /tmp/krb5cc_0
Using principal: xmpp/openfireserver.realm.local@REALM.LOCAL
Using keytab: /opt/openfire/xmpp.keytab
kinit: Client 'xmpp/openfireserver.realm.local@REALM.LOCAL' not found in Kerberos database while getting initial credentials</pre>

При этом с ключом все в порядке

<pre>klist -ek /opt/openfire/xmpp.keytab 
Keytab name: FILE:/opt/openfire/xmpp.keytab
KVNO Principal
---- --------------------------------------------------------------------------
   4 xmpp/openfireserver.realm.local@REALM.LOCAL (arcfour-hmac)</pre>

В логах контроллера домена
  
`Существует несколько учетных записей с именем xmpp/openfireserver.realm.local типа DS_SERVICE_PRINCIPAL_NAME.`

Здесь следует проверить нет ли дублей. По всей видимости есть еще одна учетка привязанная к xmpp/openfireserver.realm.local

На win2008 можно выполнить
  
`> setspn -x`

На win2003 придется искать эту учетку вручную и проверять

<pre>> setspn -L xmpp-openfire
Registered ServicePrincipalNames for CN=xmpp-openfire,CN=Users,DC=realm,DC=local:
    xmpp/openfireserver.realm.local
    xmpp/openfireserver.realm.local@REALM.LOCAL</pre>

<pre>> setspn -L xmpp-openfire2
Registered ServicePrincipalNames for CN=xmpp-openfire2,CN=Users,DC=realm,DC=local:
    xmpp/openfireserver.realm.local
    xmpp/openfireserver.realm.local@REALM.LOCAL</pre>

При совпадении достаточно удалить лишнюю привязку 

<pre>>setspn -D xmpp/openfireserver.realm.local xmpp-openfire2
Unregistering ServicePrincipalNames for CN=xmpp-openfire2,CN=Users,DC=realm,DC=local
        xmpp/openfireserver.realm.local
Updated object</pre>

<pre>>setspn -D xmpp/openfireserver.realm.local@REALM.LOCAL xmpp-openfire2
Unregistering ServicePrincipalNames for CN=xmpp-openfire2,CN=Users,DC=realm,DC=local
        xmpp/openfireserver.realm.local@REALM.LOCAL
Updated object</pre>

Вторая ошибка исходила из первой, а именно из-за имени учетки xmpp-openfire2

<pre>kinit -V -k -t /opt/openfire/xmpp.keytab xmpp/openfireserver.realm.local@REALM.LOCAL
Using default cache: /tmp/krb5cc_0
Using principal: xmpp/openfireserver.realm.local@REALM.LOCAL
Using keytab: /opt/openfire/xmpp.keytab
kinit: Unsupported key table format version number while getting initial credentials</pre>

В логах контроллера домена
  
`Существует несколько учетных записей с именем xmpp/openfireserver.realm.local@REALM.LOCAL типа DS_USER_PRINCIPAL_NAME.`

Дело в имени входа учетки xmpp-openfire2, оно выглядело как xmpp/openfireserver.realm.local, правим его на xmpp-openfire2. 

Теперь при попытке проверить ключ я получал долгожданное
  
Authenticated to Kerberos v5