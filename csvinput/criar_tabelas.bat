@Echo off
echo.
echo Cria��o das tabelas no MySQL
echo.
pause
mysql -uroot -p123@manager conveniomysql <criar_tabelas.sql
