use conveniomysql;

select 'Dropando tabela de Proponentes por Propostas' AS '';

DROP TABLE IF EXISTS PROPOSTAS_PROPONENTE;

select 'Criando tabela de Proponentes por Propostas' AS '';

CREATE TABLE PROPOSTAS_PROPONENTE ( 
ANO_PROPOSTA			int(4)		not null,
NR_PROPOSTA			varchar(6)	not null,
ANO_CONVENIO			int(4)		not null,
NR_CONVENIO			varchar(6)	not null,
TX_MODALIDADE			varchar(40)	not null,
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
NM_MUNICIPIO_PROPONENTE		varchar(40)	not null,
DT_PROPOSTA			date		,
TX_ENDERECO_PROPONENTE		varchar(255)	not null,
NM_BAIRRO_PROPONENTE		varchar(50)	not null,
NR_CEP_PROPONENTE		varchar(9)	not null,
TX_EMAIL_PROPONENTE		varchar(80)	not null,
NR_TELEFONE_PROPONENTE		varchar(80)	not null,
NR_FAX_PROPONENTE		varchar(80)	not null,
TX_INSC_ESTADUAL_PROPONENTE	varchar(50)	not null,
TX_INSC_MUNICIPAL_PROPONENTE	varchar(50)	not null,
TX_NAT_JURIDICA_PROPONENTE	varchar(60)	not null,
CD_RESP_PROPONENTE		varchar(11)	not null,
NM_RESP_PROPONENTE		varchar(60)	not null,
CD_RESP_CONCEDENTE		varchar(11)	not null,
NM_RESP_CONCEDENTE		varchar(60)	not null,
ID_PROPOSTA			int(7)		not null,
ID_CONVENIO			int(6)		not null,
CD_MUNICIPIO_PROPONENTE		int(4)		not null );

-- Create Index PROGRAMA1 ON PROGRAMA ( CD_PROGRAMA );

