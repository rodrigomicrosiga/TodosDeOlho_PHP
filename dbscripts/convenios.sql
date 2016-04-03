use conveniomysql;

CREATE TABLE IF NOT EXISTS CONVENIOS (
ANO_CONVENIO			int(4) 		NOT NULL,
NR_CONVENIO			int(5)		NOT NULL,
ANO_PROPOSTA			int(4)		NOT NULL,
NR_PROPOSTA			int(6)		NOT NULL,
TX_MODALIDADE			varchar(40)	NOT NULL,
TX_SITUACAO			varchar(80)	NOT NULL,
TX_SUBSITUACAO			varchar(30)	NOT NULL,
CD_ORGAO_SUPERIOR		int(5)		NOT NULL,
NM_ORGAO_SUPERIOR		varchar(70)	NOT NULL,
CD_ORGAO_CONCEDENTE		int(5)		NOT NULL,
TX_ESFERA_ADM_PROPONENTE	varchar(40)	NOT NULL,
TX_REGIAO_PROPONENTE		varchar(12)	NOT NULL,
UF_PROPONENTE			char(2)		NOT NULL,
NM_MUNICIPIO_PROPONENTE		varchar(40)	NOT NULL,
ID_MUNICIPIO_PROPONENTE 	int(4) 		NOT NULL default 0 , 
CD_IDENTIF_PROPONENTE		varchar(14)	NOT NULL,
NM_PROPONENTE			varchar(150)	NOT NULL,
NM_ORGAO_CONCEDENTE		varchar(80)	NOT NULL,
DT_INCLUSAO_PROPOSTA		date , 
CD_PROGRAMA			varchar(13)	NOT NULL,
NM_PROGRAMA			varchar(255)	NOT NULL,
CD_ACAO_PPA			varchar(8)	NOT NULL,
DT_INICIO_VIGENCIA		date , 
DT_FIM_VIGENCIA			date , 
DT_ASSINATURA_CONVENIO		date , 
MES_ASSINATURA_CONVENIO		int(2)		NOT NULL,
ANO_ASSINATURA_CONVENIO		int(4)		NOT NULL,
MES_PUBLICACAO_CONVENIO		int(2)		NOT NULL,
ANO_PUBLICACAO_CONVENIO		int(4)		NOT NULL,
DT_PUBLICACAO			date , 
DT_ULTIMO_EMPENHO		date , 
DT_ULTIMO_PGTO			date , 
VL_GLOBAL			float(18,2) 	NOT NULL,
VL_REPASSE			float(18,2)	NOT NULL,
VL_CONTRAPARTIDA_TOTAL		float(18,2)	NOT NULL,
VL_CONTRAPARTIDA_FINANC		float(18,2)	NOT NULL,
VL_CONTRAPARTIDA_BENS_SERV	float(18,2)	NOT NULL,
VL_DESEMBOLSADO			float(18,2)	NOT NULL,
VL_EMPENHADO			float(18,2)	NOT NULL,
TX_OBJETO_CONVENIO		varchar(255)	NOT NULL,
TX_JUSTIFICATIVA		varchar(255)	NOT NULL,
TX_ENDERECO_PROPONENTE		varchar(255)	NOT NULL,
TX_BAIRRO_PROPONENTE		varchar(45)	NOT NULL,
NR_CEP_PROPONENTE		varchar(9)	NOT NULL,
NM_RESPONS_PROPONENTE		varchar(60)	NOT NULL,
CD_RESPONS_PROPONENTE		varchar(11)	NOT NULL,
TX_CARGO_RESPONS_PROPONENTE	varchar(120)	NOT NULL,
NM_RESPONS_CONCEDENTE		varchar(60)	NOT NULL,
CD_RESPONS_CONCEDENTE		varchar(11)	NOT NULL,
TX_CARGO_RESPONS_CONCEDENTE	varchar(120)	NOT NULL,
TX_SITUACAO_PUBLICACAO		varchar(40)	NOT NULL,
NR_PROCESSO_CONVENIO		varchar(25)	NOT NULL,
NR_INTERNO_CONVENIO		varchar(11)	NOT NULL,
IN_ASSINADO_SN			char(1)		NOT NULL,
IN_ADITIVO_SN			char(1)		NOT NULL,
IN_PUBLICADO_SN			char(1)		NOT NULL,
IN_EMPENHADO_SN			char(1)		NOT NULL,
IN_PRORROGA_OFICIO_SN		char(1)		NOT NULL,
IN_PERMITE_AJUSTE_CRON_FISICO	char(1)		NOT NULL,
QT_EMPENHOS			int(4)		NOT NULL,
QT_ADITIVOS			int(4)		NOT NULL,
QT_PRORROGAS			int(4)		NOT NULL,
TX_QUALIFIC_PROPONENTE		varchar(32)		NOT NULL,
ID_CONVENIO			int(6)		NOT NULL,
ID_PROP				int(7)		NOT NULL,
ID_PROP_PROGRAMA		int(6) 		NOT NULL );

-- Create Index CONVENIOS1 ON CONVENIOS ( ID_PROP );
-- Create Index CONVENIOS2 ON CONVENIOS ( ID_CONVENIO );
-- Create Index CONVENIOS3 ON CONVENIOS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );
-- Create Index CONVENIOS4 ON CONVENIOS ( ID_MUNICIPIO_PROPONENTE );

