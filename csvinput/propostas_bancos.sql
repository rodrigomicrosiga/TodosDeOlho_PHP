use conveniomysql;

select 'Dropando tabela de Dados Bancários de Propostas' AS '';

DROP TABLE IF EXISTS PROPOSTAS_BANCOS;

select 'Criando tabela de Dados Bancários de Propostas' AS '';

CREATE TABLE PROPOSTAS_BANCOS (
ANO_PROPOSTA			int(4)		not null,
NR_PROPOSTA			varchar(6)	not null,
ANO_CONVENIO			int(4)		not null,
NR_CONVENIO			varchar(6)	not null,
TX_MODALIDADE			varchar(35)	not null,
TX_SITUACAO			varchar(80)	not null,
TX_SUBSITUACAO			varchar(40)	not null,
CD_ORGAO_SUPERIOR		int(5)		not null,
NM_ORGAO_SUPERIOR		varchar(70)	not null,
CD_ORGAO_CONCEDENTE		int(5)		not null,
NM_ORGAO_CONCEDENTE		varchar(70)	not null,
CD_IDENTIF_PROPONENTE		varchar(14)	not null,
NM_PROPONENTE			varchar(150)	not null,
TX_ESFERA_ADM_PROPONENTE	varchar(40)	not null,
TX_REGIAO_PROPONENTE		varchar(12)	not null,
UF_PROPONENTE			char(2)		not null,
NM_MUNICIPIO_PROPONENTE		varchar(70)	not null,
DT_PROPOSTA			date		,
NM_BANCO			varchar(40)	not null,
CD_AGENCIA			varchar(13)	not null,
DV_AGENCIA			varchar(13)	not null,
NR_CONTA_CORRENTE		varchar(13)	not null,
TX_CONTA_CORRENTE		varchar(30)	not null,
DT_ULTIMA_MODIFICACAO		date		,
ID_PROPOSTA			int(7)		not null,
ID_CONVENIO			int(6) 		not null );


