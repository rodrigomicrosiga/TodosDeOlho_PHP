use conveniomysql;

select 'Dropando tabela de Cronogramde de Desembolso' AS '';

DROP TABLE IF EXISTS CRONOGRAMA_DESEMBOLSO;

select 'Criando tabela de Cronogramde de Desembolso' AS '';

CREATE TABLE CRONOGRAMA_DESEMBOLSO ( 
NR_PARCELA			varchar(5)	not null,
TX_TIPO				varchar(30)	not null,
TX_MES				int(2)		not null,
TX_ANO				int(4)		not null,
VL_PARCELA			float(18,2)	not null,	
ID_CONVENIO			int(6)		not null,
ID_PROPOSTA			int(7)		not null
);


