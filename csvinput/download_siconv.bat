@echo off
echo.
echo Download dos arquivos CSV do Portal de Convenios
echo.
pause
echo Apagando CSVs anteriores
del *.csv
for /f %%a in (links_siconv.txt) do @curl -k -O %%a
echo.
echo Download Terminado - Confira os arquivos.
echo.
dir *.csv
