@Echo off
echo.
echo Importando dados CSV em PHP para o MySQL
echo.
pause
for %%a in (csv_*.php) do @php %%a
echo.
echo Criando �ndices e amarrando informa��es
echo.
mysql -uubuntu -pavelinos < post_import.sql
echo.
echo Importa��o de CSV terminada
echo.
