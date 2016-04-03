@Echo off
echo.
echo Criação das tabelas no MySQL
echo.
pause
mysql -uroot -p123@manager conveniomysql <criar_tabelas.sql
