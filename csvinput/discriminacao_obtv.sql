use conveniomysql;

select 'Dropando tabela de Discriminação OBTV' AS '';

DROP TABLE IF EXISTS DISCRIMINACAO_OBTV;

select 'Criando tabela de Discriminação OBTV' AS '';

CREATE TABLE DISCRIMINACAO_OBTV (
ANO_CONVENIO			int(4)		NOT NULL,
NR_CONVENIO			varchar(6)	NOT NULL,
TX_MODALIDADE			varchar(20)	NOT NULL,
TX_SITUACAO			varchar(45)	NOT NULL,
NM_BANCO_CONVENIO		varchar(30)	NOT NULL,
CD_AGENCIA_CONVENIO		int(4)		NOT NULL,
NR_CONTA_CORRENTE_CONVENIO	varchar(10)	NOT NULL,
TX_SITUACAO_CONTA_CORRENTE	varchar(20)	NOT NULL,
CD_ORGAO_CONCEDENTE		int(5)		NOT NULL,
NM_ORGAO_CONCEDENTE		varchar(60)	NOT NULL,
CD_IDENT_CONVENENTE		varchar(14)	NOT NULL,
NM_IDENT_CONVENENTE		varchar(132)	NOT NULL,
TX_ESFERA_ADM_CONVENENTE	varchar(40)	NOT NULL,
NM_MUNICIPIO_CONVENENTE		varchar(40)	NOT NULL,
UF_CONVENENTE			char(2)		NOT NULL,
TX_REGIAO_CONVENENTE		varchar(12)	NOT NULL,
NR_MOVIMENTACAO_FINANCEIRA	varchar(7)	NOT NULL,
VL_PAGAMENTO			float(18,2)	NOT NULL,
ID_CONVENIO			int(6)		NOT NULL,
TX_FORMA_PAGAMENTO		varchar(45)	NOT NULL,
TX_SITUACAO_DISCRIMINACAO	varchar(11)	NOT NULL,
NR_DOCUMENTO_ITEM		varchar(20)	NOT NULL,
DT_EMISSAO			date		,
DT_PAGAMENTO			date		,
TP_IDENTIF_FAVORECIDO		varchar(4)	NOT NULL,
NR_IDENTIF_FAVORECIDO		varchar(20)	NOT NULL,
NM_FAVORECIDO			varchar(150)	NOT NULL,
TX_TIPO_AQUISICAO		varchar(50)	NOT NULL,
TX_DESCRICAO_ITEM		varchar(255)	NOT NULL,
TX_TIPO_DOCUMENTO_ITEM		varchar(64)	NOT NULL );	

