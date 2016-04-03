# TodosDeOlho_PHP
Projeto Todos de Olho - Apache / PHP

Vers�o de desenvolvimento (Windows):

Windows 10 
Apache 2.4.18
PHP 5.6.19
MySQL 5.6.25

Prot�tipo funcional (Linux):

Ubuntu 14.04.4
Apache 2.4.7
PHP 5.5.9-1
Mysql 5.5.47

Setup de Ambiente

=) A pasta raiz de publica��es web � a "webroot".
=) Configurar o Apache, PHO e MySQL
=) Criar um banco de dados para a aplica��o com o nome "conveniomysql"
=) Configure a pasta de incudes do PHP para a pasta "/webroot/php"
=) Edite o arquivo /webroot/php/dbconn.php, para informar usu�rio, senha e nome da inst�ncia do MySQL
=) Entre na pasta "csvinput"
=) Execute "download_siconv.sh" ( ou download_siconv.bat para Windows )  
   -- Ele far� o download dos arquivos .CSV do SICONV
   -- Requer CURL no Path da linha de comando
   -- Ser�o realiados os downloads dos CSVs necess�rios para alimentar o site
=) Entre na pasta "dbscripts"
=) Execute o comando cria_tabelas.sh ( ou cria_tabelas.bat ) 
   -- Certifique-se de que o usu�rio atual possa acessar o MySQL sem senha
   -- Requer o MySLQ no path da linha de comando 
   -- Os scripts v�o criar e popular algumas tabelas do site 
   -- A conex�o ser� feita com o MysQL configurado no dbconn.php
=) Entre na pasta "DBImport"
=) Execute o comando import_csv.sh ( ou import_csv.bat para Windows)
   -- Requer o PHP no Path da linha de comando
   -- Os PHPs executados v�o importar os CSVs da pasta "/importcsv" para as tabelas do MYSQL

   
