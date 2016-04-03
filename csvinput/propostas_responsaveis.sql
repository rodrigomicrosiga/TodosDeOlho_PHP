use conveniomysql;

select 'Dropando tabela de Responsáveis por Propostas' AS '';

DROP TABLE IF EXISTS PROPOSTAS_RESPONSAVEIS;

select 'Criando tabela de Responsáveis por Propostas' AS '';

CREATE TABLE PROPOSTAS_RESPONSAVEIS ( 
ANO_PROPOSTA					int(4)			not null,
NR_PROPOSTA						varchar(6)		not null,
ANO_CONVENIO					int(4)			not null,
NR_CONVENIO						varchar(6)		not null,
TX_MODALIDADE					varchar(40)		not null,
TX_SITUACAO						varchar(80)		not null,
TX_SUBSITUACAO					varchar(40)		not null,
CD_ORGAO_SUPERIOR				int(5)			not null,
NM_ORGAO_SUPERIOR				varchar(70)		not null,
CD_ORGAO_CONCEDENTE				int(5)			not null,
NM_ORGAO_CONCEDENTE				varchar(70)		not null,
CD_IDENTIF_PROPONENTE			varchar(14)		not null,
NM_PROPONENTE					varchar(150)	not null,
TX_ESFERA_ADM_PROPONENTE		varchar(40)		not null,
TX_REGIAO_PROPONENTE			varchar(12)		not null,
UF_PROPONENTE					char(2)			not null,
NM_MUNICIPIO_PROPONENTE			varchar(40)		not null,
DT_PROPOSTA						date			,
CD_RESP_PROPONENTE				varchar(11)		not null,
NM_RESP_PROPONENTE				varchar(80)		not null,
TX_CARGO_RESP_PROPONENTE		varchar(120)	not null,
NR_RG_RESP_PROPONENTE			varchar(30)		not null,
NM_ORGEXP_RG_RESP_PROPONENTE	varchar(50)		not null,
TX_ENDERECO_RESP_PROPONENTE		varchar(255)	not null,
NR_CEP_RESP_PROPONENTE			varchar(9)		not null,
NM_MUNICIPIO_RESP_PROPONENTE	varchar(40)		not null,
TX_EMAIL_RESP_PROPONENTE		varchar(80)		not null,
NM_RESP_CONCEDENTE				varchar(80)		not null,
CD_RESP_CONCEDENTE				varchar(11)		not null,
TX_CARGO_RESP_CONCEDENTE		varchar(120)	not null,
NR_RG_RESP_CONCEDENTE			varchar(40)		not null,
NM_ORGEXP_RG_RESP_CONCEDENTE	varchar(100)		not null,
NM_MUNICIPIO_RESP_CONCEDENTE	varchar(40)		not null,
ID_PROPOSTA						int(7)			not null,
ID_CONVENIO						int(6)			not null );

-- Create Index PROGRAMA1 ON PROGRAMA ( CD_PROGRAMA );

