use conveniomysql;

select 'Dropando tabela de Documentos de Liquidação' AS '';

DROP TABLE IF EXISTS DOCUMENTO_LIQUIDACAO;

select 'Criando tabela de Documentos de Liquidação' AS '';

CREATE TABLE DOCUMENTO_LIQUIDACAO ( 
ANO_CONVENIO			int(4)		not null,
NR_CONVENIO			varchar(6)	not null,
TX_MODALIDADE			varchar(20)	not null,
TX_SITUACAO			varchar(50)	not null,
NM_BANCO_CONVENIO		varchar(40)	not null,
CD_AGENCIA_CONVENIO		varchar(4)	not null,
NR_CONTA_CORRENTE_CONVENIO	varchar(12)	not null,
TX_SITUACAO_CONTA_CORRENTE	varchar(30)	not null,
CD_ORGAO_CONCEDENTE		int(5)		not null,
NM_ORGAO_CONCEDENTE		varchar(70)	not null,
CD_IDENT_CONVENENTE		varchar(14)	not null,
NM_IDENT_CONVENENTE		varchar(150)	not null,
TX_ESFERA_ADM_CONVENENTE	varchar(40)	not null,
NM_MUNICIPIO_CONVENENTE		varchar(40)	not null,
UF_CONVENENTE			char(2)		not null,
TX_REGIAO_CONVENENTE		varchar(12)	not null,
NR_CONTRATO			varchar(6)	not null,
NR_PROCESSO_DE_COMPRA		varchar(150)	not null,
NR_DOCUMENTO_LIQUIDACAO		varchar(255)	not null,
TX_FORMA_PAGAMENTO		varchar(50)	not null,
CD_IDENTIF_FAVORECIDO_DL	varchar(14)	not null,
NM_IDENTIF_FAVORECIDO_DL	varchar(150)	not null,
NUM_BANCO_FAVORECIDO_DL		varchar(3)	not null,
CD_AGENCIA_FAVORECIDO_DL	varchar(5)	not null,
NR_CONTA_CORRENTE_FAV_DL	varchar(10)	not null,
SERIE_DOCUMENTO_LIQUIDACAO	varchar(150)	not null,
TP_DOCUMENTO_LIQUIDACAO		varchar(70)	not null,
DT_EMISSAO_DL			date		,
DT_SAIDA_DL			date		,
VL_BRUTO_DL			float(18,2)	not null,
VL_LIQUIDO_DL			float(18,2)	not null,
ID_CONVENIO			int(6)		not null,
ID_DOCLIQUIDACAO		int(7)		not null );

