use conveniomysql;

select 'Dropando tabela de Beneficiários Específicos de Propostas' AS '';

DROP TABLE IF EXISTS PROPOSTAS_BENEFESPECIF;

select 'Criando tabela de Beneficiários Específicos de Propostas' AS '';

CREATE TABLE PROPOSTAS_BENEFESPECIF ( 
NR_CNPJ_BENEF_ESPECIFICO		varchar(14)	not null,
NM_BENEF_ESPECIFICO			varchar(150)	not null,
VL_REPASSE_BENEF_ESPECIFICO		float(18,2)	not null,
ID_PROPOSTA				int(7)		not null,
ID_CONVENIO				int(6)		not null,
ID_PROP_PROGRAMA			int(6)		not null );

