# TodosDeOlho_PHP
Projeto Todos de Olho - Apache / PHP

Versão de desenvolvimento (Windows):

Windows 10 
Apache 2.4.18
PHP 5.6.19
MySQL 5.6.25

Protótipo funcional (Linux):

Ubuntu 14.04.4
Apache 2.4.7
PHP 5.5.9-1
Mysql 5.5.47

Setup de Ambiente

=) A pasta raiz de publicações web é a "webroot".
=) Configurar o Apache, PHO e MySQL
=) Criar um banco de dados para a aplicação com o nome "conveniomysql"
=) Configure a pasta de incudes do PHP para a pasta "/webroot/php"
=) Edite o arquivo /webroot/php/dbconn.php, para informar usuário, senha e nome da instância do MySQL
=) Entre na pasta "csvinput"
=) Execute "download_siconv.sh" ( ou download_siconv.bat para Windows )  
   -- Ele fará o download dos arquivos .CSV do SICONV
   -- Requer CURL no Path da linha de comando
   -- Serão realiados os downloads dos CSVs necessários para alimentar o site
=) Entre na pasta "dbscripts"
=) Execute o comando cria_tabelas.sh ( ou cria_tabelas.bat ) 
   -- Certifique-se de que o usuário atual possa acessar o MySQL sem senha
   -- Requer o MySLQ no path da linha de comando 
   -- Os scripts vão criar e popular algumas tabelas do site 
   -- A conexão será feita com o MysQL configurado no dbconn.php
=) Entre na pasta "DBImport"
=) Execute o comando import_csv.sh ( ou import_csv.bat para Windows)
   -- Requer o PHP no Path da linha de comando
   -- Os PHPs executados vão importar os CSVs da pasta "/importcsv" para as tabelas do MYSQL

   
