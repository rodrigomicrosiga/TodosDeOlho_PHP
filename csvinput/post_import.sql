use conveniomysql;

select 'Criando �ndices de Convenios' AS '';

Create Index CONVENIOS1 ON CONVENIOS ( ID_PROP );
Create Index CONVENIOS2 ON CONVENIOS ( ID_CONVENIO );
Create Index CONVENIOS3 ON CONVENIOS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );

select 'Atualizando C�digo de Munic�pios nos Conv�nios' AS '';

update  CONVENIOS c, MUNICIPIOS m set c.ID_MUNICIPIO_PROPONENTE = m.CODIGO 
	where c.UF_PROPONENTE = m.UF and c.NM_MUNICIPIO_PROPONENTE = m.NOME ;

Create Index CONVENIOS4 ON CONVENIOS ( ID_MUNICIPIO_PROPONENTE , DT_INCLUSAO_PROPOSTA );

select 'Criando �ndices de Cronograma de Desembolao' AS '';
Create index CRONOGRAMA_D1 ON CRONOGRAMA_DESEMBOLSO( ID_CONVENIO,TX_ANO,TX_MES );
Create index CRONOGRAMA_D2 ON CRONOGRAMA_DESEMBOLSO( ID_PROPOSTA,TX_ANO,TX_MES );

select 'Criando �ndices de Cronograma f�sico' AS '';
Create index CRONOFRAMA_F1 ON CRONOGRAMA_FISICO( ID_CONVENIO,DT_INICIO );
Create index CRONOFRAMA_F2 ON CRONOGRAMA_FISICO( ID_PROPOSTA,DT_INICIO );

select 'Criando �ndices de Propostas' AS '';
Create Index PROPOSTAS1 ON PROPOSTAS ( ID_PROPOSTA );
Create Index PROPOSTAS2 ON PROPOSTAS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );

select 'Atualizando C�digo de Munic�pios nas Propostas' AS '';
update  PROPOSTAS p, MUNICIPIOS m set p.ID_MUNICIPIO_PROPONENTE = m.CODIGO 
	where p.UF_PROPONENTE = m.UF and p.NM_MUNICIPIO_PROPONENTE = m.NOME ;

Create Index PROPOSTAS3 ON PROPOSTAS ( ID_MUNICIPIO_PROPONENTE , DT_PROPOSTA );

select 'Criando �ndices de Execu��o Financeita' AS '';
Create Index EXECUCAOFIN1 ON EXECUCAOFIN ( ID_CONVENIO , DT_DESEMBOLSO );
Create Index EXECUCAOFIN2 ON EXECUCAOFIN ( ID_PROP , DT_DESEMBOLSO );

select 'Criando �ndices de Discrimina��o OBTV' AS '';
Create Index DISCRIMINACAO_O1 on DISCRIMINACAO_OBTV( ID_CONVENIO , DT_EMISSAO );

select 'Criando �ndices de Documento de Liquida��o' AS '';
Create Index DOCUMENTO_L1 on DOCUMENTO_LIQUIDACAO(ID_CONVENIO,DT_EMISSAO_DL);
Create Index DOCUMENTO_L2 on DOCUMENTO_LIQUIDACAO(ID_DOCLIQUIDACAO,DT_EMISSAO_DL);

select 'Criando �ndices de Empenhos' AS '';
Create Index EMPENHOS1 ON EMPENHOS ( ID_PROP , DT_EMISSAO_EMPENHO );
Create Index EMPENHOS2 ON EMPENHOS ( ID_CONVENIO , DT_EMISSAO_EMPENHO );

select 'Criando �ndices de Pagamentos OBTV' AS '';
Create Index PAGAMENTO_O1 ON PAGAMENTO_OBTV( ID_CONVENIO );
Create Index PAGAMENTO_O2 ON PAGAMENTO_OBTV( ID_DOCLIQUIDACAO );

select 'Criando �ndices de Plano de Aplica��o Detalhado' AS '';
Create Index PLANOAP1 ON PLANOAP ( ID_PROPOSTA );
Create Index PLANOAP2 ON PLANOAP ( ID_CONVENIO );

select 'Criando �ndices de Programas' AS '';
Create Index PROGRAMA1 ON PROGRAMA ( CD_PROGRAMA );
Create Index PROGRAMA2 ON PROGRAMA ( ID_PROGRAMA_CONVENIO );

select 'Criando �ndices de Estados HAbilitados por Programa' AS '';
Create Index PROGRAMAS_UF1 on PROGRAMAS_UF (CD_PROGRAMA);
Create Index PROGRAMAS_UF2 on PROGRAMAS_UF (ID_PROGRAMA_CONVENIO);
 
select 'Criando �ndices de Dados Banc�rios das Propostas' AS '';
Create Index PROPOSTAS_BANCO1 on PROPOSTAS_BANCOS (ID_PROPOSTA);
Create Index PROPOSTAS_BANCO2 on PROPOSTAS_BANCOS (ID_CONVENIO);
 
select 'Criando �ndices de Benefici�rio Espec�fico das Propostas' AS '';
Create Index PROPOSTAS_BENEF1 on PROPOSTAS_BENEFESPECIF (ID_PROPOSTA);
Create Index PROPOSTAS_BENEF2 on PROPOSTAS_BENEFESPECIF (ID_CONVENIO);
Create Index PROPOSTAS_BENEF3 on PROPOSTAS_BENEFESPECIF (ID_PROP_PROGRAMA);

select 'Criando �ndices de Emendas das Propostas' AS '';
Create Index PROPOSTAS_EMENDA1 on PROPOSTAS_EMENDAP (ID_PROPOSTA);
Create Index PROPOSTAS_EMENDA2 on PROPOSTAS_EMENDAP (ID_CONVENIO);
Create Index PROPOSTAS_EMENDA3 on PROPOSTAS_EMENDAP (ID_PROP_PROGRAMA);

