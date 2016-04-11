use conveniomysql;

select 'Atualizando C�digo de Munic�pios nos Conv�nios' AS 'Aguarde';

update  CONVENIOS c, MUNICIPIOS m set c.ID_MUNICIPIO_PROPONENTE = m.CODIGO 
	where c.UF_PROPONENTE = m.UF and c.NM_MUNICIPIO_PROPONENTE = m.NOME ;

select 'Atualizando C�digo de Munic�pios nas Propostas' AS 'Aguarde';
update  PROPOSTAS p, MUNICIPIOS m set p.ID_MUNICIPIO_PROPONENTE = m.CODIGO 
	where p.UF_PROPONENTE = m.UF and p.NM_MUNICIPIO_PROPONENTE = m.NOME ;


select 'Criando �ndices de Convenios' AS 'Aguarde';

Create Index CONVENIOS1 ON CONVENIOS ( ID_PROP );
Create Index CONVENIOS2 ON CONVENIOS ( ID_CONVENIO );
Create Index CONVENIOS3 ON CONVENIOS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );
create index CONVENIOS4 on CONVENIOS ( ID_MUNICIPIO_PROPONENTE , CD_ORGAO_CONCEDENTE, NM_ORGAO_CONCEDENTE, VL_GLOBAL) ;


select 'Criando �ndices de Cronograma de Desembolao' AS 'Aguarde';
Create index CRONOGRAMA_D1 ON CRONOGRAMA_DESEMBOLSO( ID_CONVENIO,TX_ANO,TX_MES );
Create index CRONOGRAMA_D2 ON CRONOGRAMA_DESEMBOLSO( ID_PROPOSTA,TX_ANO,TX_MES );

select 'Criando �ndices de Cronograma f�sico' AS 'Aguarde';
Create index CRONOFRAMA_F1 ON CRONOGRAMA_FISICO( ID_CONVENIO,DT_INICIO );
Create index CRONOFRAMA_F2 ON CRONOGRAMA_FISICO( ID_PROPOSTA,DT_INICIO );

select 'Criando �ndices de Propostas' AS 'Aguarde';
Create Index PROPOSTAS1 ON PROPOSTAS ( ID_PROPOSTA );
Create Index PROPOSTAS2 ON PROPOSTAS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );
create index PROPOSTAS3 on PROPOSTAS ( ID_MUNICIPIO_PROPONENTE , CD_ORGAO_CONCEDENTE, NM_ORGAO_CONCEDENTE, VL_GLOBAL) ;


select 'Criando �ndices de Execu��o Financeita' AS 'Aguarde';
Create Index EXECUCAOFIN1 ON EXECUCAOFIN ( ID_CONVENIO , DT_DESEMBOLSO );
Create Index EXECUCAOFIN2 ON EXECUCAOFIN ( ID_PROP , DT_DESEMBOLSO );

select 'Criando �ndices de Discrimina��o OBTV' AS 'Aguarde';
Create Index DISCRIMINACAO_O1 on DISCRIMINACAO_OBTV( ID_CONVENIO , DT_EMISSAO );

select 'Criando �ndices de Documento de Liquida��o' AS 'Aguarde';
Create Index DOCUMENTO_L1 on DOCUMENTO_LIQUIDACAO(ID_CONVENIO,DT_EMISSAO_DL);
Create Index DOCUMENTO_L2 on DOCUMENTO_LIQUIDACAO(ID_DOCLIQUIDACAO,DT_EMISSAO_DL);

select 'Criando �ndices de Empenhos' AS 'Aguarde';
Create Index EMPENHOS1 ON EMPENHOS ( ID_PROP , DT_EMISSAO_EMPENHO );
Create Index EMPENHOS2 ON EMPENHOS ( ID_CONVENIO , DT_EMISSAO_EMPENHO );

select 'Criando �ndices de Pagamentos OBTV' AS 'Aguarde';
Create Index PAGAMENTO_O1 ON PAGAMENTO_OBTV( ID_CONVENIO );
Create Index PAGAMENTO_O2 ON PAGAMENTO_OBTV( ID_DOCLIQUIDACAO );

select 'Criando �ndices de Plano de Aplica��o Detalhado' AS 'Aguarde';
Create Index PLANOAP1 ON PLANOAP ( ID_PROPOSTA );
Create Index PLANOAP2 ON PLANOAP ( ID_CONVENIO );

select 'Criando �ndices de Programas' AS 'Aguarde';
Create Index PROGRAMAS1 ON PROGRAMAS ( CD_PROGRAMA );
Create Index PROGRAMAS2 ON PROGRAMAS ( ID_PROGRAMA_CONVENIO );

select 'Criando �ndices de Estados HAbilitados por Programa' AS 'Aguarde';
Create Index PROGRAMAS_UF1 on PROGRAMAS_UF (CD_PROGRAMA);
Create Index PROGRAMAS_UF2 on PROGRAMAS_UF (ID_PROGRAMA_CONVENIO);
 
select 'Criando �ndices de Dados Banc�rios das Propostas' AS 'Aguarde';
Create Index PROPOSTAS_BANCO1 on PROPOSTAS_BANCOS (ID_PROPOSTA);
Create Index PROPOSTAS_BANCO2 on PROPOSTAS_BANCOS (ID_CONVENIO);
 
select 'Criando �ndices de Benefici�rio Espec�fico das Propostas' AS 'Aguarde';
Create Index PROPOSTAS_BENEF1 on PROPOSTAS_BENEFESPECIF (ID_PROPOSTA);
Create Index PROPOSTAS_BENEF2 on PROPOSTAS_BENEFESPECIF (ID_CONVENIO);
Create Index PROPOSTAS_BENEF3 on PROPOSTAS_BENEFESPECIF (ID_PROP_PROGRAMA);

select 'Criando �ndices de Emendas das Propostas' AS 'Aguarde';
Create Index PROPOSTAS_EMENDA1 on PROPOSTAS_EMENDAP (ID_PROPOSTA);
Create Index PROPOSTAS_EMENDA2 on PROPOSTAS_EMENDAP (ID_CONVENIO);
Create Index PROPOSTAS_EMENDA3 on PROPOSTAS_EMENDAP (ID_PROP_PROGRAMA);

select 'Criando �ndices de Proponentes' AS 'Aguarde';
Create Index PROPOSTAS_PROP1 on PROPOSTAS_PROPONENTE (ID_PROPOSTA);
Create Index PROPOSTAS_PROP2 on PROPOSTAS_PROPONENTE (ID_CONVENIO);

select 'Criando �ndices de Responsaveis' AS 'Aguarde';
Create Index PROPOSTAS_RESP1 on PROPOSTAS_RESPONSAVEIS (ID_PROPOSTA);
Create Index PROPOSTAS_RESP2 on PROPOSTAS_RESPONSAVEIS (ID_CONVENIO);


