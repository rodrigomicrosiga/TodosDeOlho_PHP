@Echo off
echo.
echo Importando dados CSV em PHP para o MySQL
echo.
pause
for %%a in (csv_*.php) do @php %%a
echo.
echo Criando índices e amarrando informações
echo.
mysql -uubuntu -pavelinos < post_import.sql
echo.
echo Importação de CSV terminada
echo.
