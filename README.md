# TodosDeOlho_PHP
Projeto Todos de Olho - Apache / PHP

Vers�o de desenvolvimento (Windows):

Windows 10 
Apache 2.4.18
PHP 5.6.19
MySQL 5.6.25

Host: http://siga984.no-ip.org:7000/

Prot�tipo funcional (Linux):

Ubuntu 14.04.4
Apache 2.4.7
PHP 5.5.9-1
Mysql 5.5.47

Host: http://todosdeolho.no-ip.org/

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
=) Execute o comando cria_tabelas.sh ( ou cria_tabelas.bat ) 
   -- Requer o MySLQ no path da linha de comando 
   -- Os scripts v�o criar todas as tabelas do site e popular algumas tabelas pr�-definidas.
   -- Edite o arquivo de chamada para informar por linha de comando o usuario e senha do MySQL
=) Execute o comando importar_tabelas.sh ( ou importar_tabelas.bat para Windows)
   -- Requer o PHP no Path da linha de comando
   -- Certifique-se de alterar o dbconn.php da pasta "csvinput" para informar usuario e senha do MySQL
   -- Os PHPs executados v�o importar os CSVs baixados na pasta atual para o MySQL
   -- No final deste processo � executado um script final, que cria os �ndices


