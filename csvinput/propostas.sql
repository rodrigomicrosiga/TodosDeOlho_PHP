use conveniomysql;

select 'Dropando tabela de Propostas por Programa' AS '';

DROP TABLE IF EXISTS PROPOSTAS;

select 'Criando tabela de Propostas por Programa' AS '';

CREATE TABLE PROPOSTAS (
ANO_PROPOSTA		int(4) 		NOT NULL ,
NR_PROPOSTA		int(6) 		NOT NULL ,
ANO_CONVENIO    	int(4) 		NOT NULL ,
NR_CONVENIO     	int(6) 		NOT NULL ,
TX_MODALIDADE   	varchar(40) 	NOT NULL ,
TX_SITUACAO     	varchar(80) 	NOT NULL ,
TX_SUBSITUACAO 		varchar(30) 	NOT NULL ,
CD_PROGRAMA     	varchar(13) 	NOT NULL ,
CD_ACAO_PROGRAMA 	varchar(8) 	NOT NULL ,
NM_PROGRAMA		varchar(255)	NOT NULL , 
CD_ORGAO_SUPERIOR	int(5)		NOT NULL , 
NM_ORGAO_SUPERIOR	varchar(70)	NOT NULL , 
CD_ORGAO_CONCEDENTE	int(5)		NOT NULL , 
NM_ORGAO_CONCEDENTE	varchar(70)	NOT NULL , 
CD_IDENTIF_PROPONENTE	varchar(14) 	NOT NULL ,
NM_PROPONENTE		varchar(150) 	NOT NULL ,
TX_ESFERA_ADM_PROPONENTE varchar(40)	NOT NULL ,
TX_REGIAO_PROPONENTE	varchar(12)	NOT NULL ,
UF_PROPONENTE		char(2)	NOT NULL ,
NM_MUNICIPIO_PROPONENTE varchar(32)	NOT NULL ,
ID_MUNICIPIO_PROPONENTE int(4) NOT NULL default 0,
DT_PROPOSTA		date , 
DT_INICIO_VIGENCIA	date , 
DT_FIM_VIGENCIA		date , 
DT_ASSINATURA		date , 
ANO_ASSINATURA		int(4)	,
MES_ASSINATURA		int(2)	,
DT_PUBLICACAO		date ,
VL_GLOBAL		float(18,2)	NOT NULL ,
VL_REPASSE		float(18,2)	NOT NULL ,
VL_REPASSE_EXERC_ATUAL	float(18,2)	NOT NULL ,
VL_CONTRAPARTIDA	float(18,2)	NOT NULL ,
VL_CONTRAPARTIDA_FINANC	float(18,2)	NOT NULL ,
VL_CONTRAPARTIDA_BENS_SERV float(18,2)	NOT NULL ,
TX_QUALIFIC_PROPONENTE	varchar(32)	NOT NULL ,
IN_PARECER_GESTOR_SN	char(1)	NOT NULL ,
IN_PARECER_JURIDICO_SN  char(1)	NOT NULL ,
IN_PARECER_TECNICO_SN   char(1)	NOT NULL ,
NM_RESPONS_PROPONENTE	varchar(60)	NOT NULL ,
CD_RESPONS_PROPONENTE	varchar(11)	NOT NULL ,
NM_RESPONS_CONCEDENTE	varchar(60)	NOT NULL ,
CD_RESPONS_CONCEDENTE	varchar(11)	NOT NULL ,
NM_BANCO		varchar(30)	NOT NULL ,
TX_OBJETO_CONVENIO	varchar(255)	NOT NULL ,
TX_JUSTIFICATIVA	varchar(255)	NOT NULL ,
ID_PROPOSTA		int(7)	NOT NULL ,
ID_CONVENIO		int(6)	NOT NULL ,
ID_PROP_PROGRAMA	int(6)	NOT NULL );

