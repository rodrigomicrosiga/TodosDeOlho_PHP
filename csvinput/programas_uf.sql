use conveniomysql;

select 'Dropando tabela de Estado Habilitado por Programa' AS '';

DROP TABLE IF EXISTS PROGRAMAS_UF;

select 'Criando tabela de Estado Habilitado por Programa' AS '';

CREATE TABLE PROGRAMAS_UF ( 
CD_PROGRAMA		varchar(13) 	not null,
UF_HABILITADA		varchar(30) 	not null,
TX_REGIAO_GEOGRAFICA	varchar(12)	not null,
ID_PROGRAMA_CONVENIO	int(5)		not null );

