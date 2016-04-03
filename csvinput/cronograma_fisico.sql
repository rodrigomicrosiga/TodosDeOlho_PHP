use conveniomysql;

select 'Dropando tabela de Cronogramde Fisico' AS '';

DROP TABLE IF EXISTS CRONOGRAMA_FISICO;

select 'Criando tabela de Cronogramde Fisico' AS '';

CREATE TABLE CRONOGRAMA_FISICO ( 
ANO_PROPOSTA			int(4)		not null,
NR_PROPOSTA			varchar(6)	not null,
TX_SITUACAOPROPOSTA		varchar(80)	not null,
TX_MODALIDADE			varchar(40)	not null,
ANO_CONVENIO			int(4)		not null,
NR_CONVENIO			varchar(6)	not null,
CD_ORGAO_CONCEDENTE		int(5)		not null,
NM_ORGAO_CONCEDENTE		varchar(80)	not null,
CD_IDENT_PROPONENTE		varchar(14)	not null,
NM_IDENT_PROPONENTE		varchar(150)	not null,
TP_IDENT_PROPONENTE		varchar(4)	not null,
TX_ESFERA_ADM_PROPONENTE	varchar(40)	not null,
NM_MUNICIPIO_PROPONENTE		varchar(40)	not null,
UF_PROPONENTE			char(2)		not null,
TX_REGIAO_PROPONENTE		varchar(12)	not null,
TX_ESPECIFICACAO		varchar(260)	not null,
DT_INICIO			date		,
DT_TERMINO			date		,
VL_META				float(18,2)	not null,
ID_CONVENIO			int(6)		not null,
ID_PROPOSTA			int(7)		not null );

