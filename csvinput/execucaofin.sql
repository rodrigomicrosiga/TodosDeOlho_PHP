use conveniomysql;

select 'Dropando tabela de Execução Fianceira' AS '';

DROP TABLE IF EXISTS EXECUCAOFIN;

select 'Criando tabela de Execução Fianceira' AS '';

CREATE TABLE EXECUCAOFIN (
CD_UG_EMITENTE			varchar(6)	NOT NULL,
CD_GESTAO_EMITENTE		varchar(6)	NOT NULL,
TX_TIPO_DOCUMENTO		varchar(4)	NOT NULL,
DT_DESEMBOLSO			date , 
MES_DESEMBOLSO			int(2)	NOT NULL,
ANO_DESEMBOLSO			int(4)	NOT NULL,
VL_DESEMBOLSADO			float(18,2)	NOT NULL,
NR_INTERNO			varchar(4)	NOT NULL,
NR_SIAFI			varchar(12)	NOT NULL,
NR_CANCELAMENTO			varchar(12)	NOT NULL,
ID_CONVENIO			int(6)	NOT NULL,
ID_PROP				int(7)	NOT NULL
);

