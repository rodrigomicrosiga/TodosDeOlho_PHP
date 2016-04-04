use conveniomysql;

select 'Criando Índices de Convenios' AS '';

Create Index CONVENIOS1 ON CONVENIOS ( ID_PROP );
Create Index CONVENIOS2 ON CONVENIOS ( ID_CONVENIO );
Create Index CONVENIOS3 ON CONVENIOS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );

select 'Atualizando Código de Municípios nos Convênios' AS '';

update  CONVENIOS c, MUNICIPIOS m set c.ID_MUNICIPIO_PROPONENTE = m.CODIGO 
	where c.UF_PROPONENTE = m.UF and c.NM_MUNICIPIO_PROPONENTE = m.NOME ;

Create Index CONVENIOS4 ON CONVENIOS ( ID_MUNICIPIO_PROPONENTE , DT_INCLUSAO_PROPOSTA );

select 'Criando Índices de Cronograma de Desembolao' AS '';
Create index CRONOGRAMA_D1 ON CRONOGRAMA_DESEMBOLSO( ID_CONVENIO,TX_ANO,TX_MES );
Create index CRONOGRAMA_D2 ON CRONOGRAMA_DESEMBOLSO( ID_PROPOSTA,TX_ANO,TX_MES );

select 'Criando Índices de Cronograma físico' AS '';
Create index CRONOFRAMA_F1 ON CRONOGRAMA_FISICO( ID_CONVENIO,DT_INICIO );
Create index CRONOFRAMA_F2 ON CRONOGRAMA_FISICO( ID_PROPOSTA,DT_INICIO );

select 'Criando Índices de Propostas' AS '';
Create Index PROPOSTAS1 ON PROPOSTAS ( ID_PROPOSTA );
Create Index PROPOSTAS2 ON PROPOSTAS ( UF_PROPONENTE , NM_MUNICIPIO_PROPONENTE );

select 'Atualizando Código de Municípios nas Propostas' AS '';
update  PROPOSTAS p, MUNICIPIOS m set p.ID_MUNICIPIO_PROPONENTE = m.CODIGO 
	where p.UF_PROPONENTE = m.UF and p.NM_MUNICIPIO_PROPONENTE = m.NOME ;

Create Index PROPOSTAS3 ON PROPOSTAS ( ID_MUNICIPIO_PROPONENTE , DT_PROPOSTA );

select 'Criando Índices de Execução Financeita' AS '';
Create Index EXECUCAOFIN1 ON EXECUCAOFIN ( ID_CONVENIO , DT_DESEMBOLSO );
Create Index EXECUCAOFIN2 ON EXECUCAOFIN ( ID_PROP , DT_DESEMBOLSO );

select 'Criando Índices de Discriminação OBTV' AS '';
Create Index DISCRIMINACAO_O1 on DISCRIMINACAO_OBTV( ID_CONVENIO , DT_EMISSAO );

select 'Criando Índices de Documento de Liquidação' AS '';
Create Index DOCUMENTO_L1 on DOCUMENTO_LIQUIDACAO(ID_CONVENIO,DT_EMISSAO_DL);
Create Index DOCUMENTO_L2 on DOCUMENTO_LIQUIDACAO(ID_DOCLIQUIDACAO,DT_EMISSAO_DL);

select 'Criando Índices de Empenhos' AS '';
Create Index EMPENHOS1 ON EMPENHOS ( ID_PROP , DT_EMISSAO_EMPENHO );
Create Index EMPENHOS2 ON EMPENHOS ( ID_CONVENIO , DT_EMISSAO_EMPENHO );

select 'Criando Índices de Pagamentos OBTV' AS '';
Create Index PAGAMENTO_O1 ON PAGAMENTO_OBTV( ID_CONVENIO );
Create Index PAGAMENTO_O2 ON PAGAMENTO_OBTV( ID_DOCLIQUIDACAO );

select 'Criando Índices de Plano de Aplicação Detalhado' AS '';
Create Index PLANOAP1 ON PLANOAP ( ID_PROPOSTA );
Create Index PLANOAP2 ON PLANOAP ( ID_CONVENIO );

select 'Criando Índices de Programas' AS '';
Create Index PROGRAMA1 ON PROGRAMA ( CD_PROGRAMA );
Create Index PROGRAMA2 ON PROGRAMA ( ID_PROGRAMA_CONVENIO );

select 'Criando Índices de Estados HAbilitados por Programa' AS '';
Create Index PROGRAMAS_UF1 on PROGRAMAS_UF (CD_PROGRAMA);
Create Index PROGRAMAS_UF2 on PROGRAMAS_UF (ID_PROGRAMA_CONVENIO);
 
select 'Criando Índices de Dados Bancários das Propostas' AS '';
Create Index PROPOSTAS_BANCO1 on PROPOSTAS_BANCOS (ID_PROPOSTA);
Create Index PROPOSTAS_BANCO2 on PROPOSTAS_BANCOS (ID_CONVENIO);
 
select 'Criando Índices de Beneficiário Específico das Propostas' AS '';
Create Index PROPOSTAS_BENEF1 on PROPOSTAS_BENEFESPECIF (ID_PROPOSTA);
Create Index PROPOSTAS_BENEF2 on PROPOSTAS_BENEFESPECIF (ID_CONVENIO);
Create Index PROPOSTAS_BENEF3 on PROPOSTAS_BENEFESPECIF (ID_PROP_PROGRAMA);

select 'Criando Índices de Emendas das Propostas' AS '';
Create Index PROPOSTAS_EMENDA1 on PROPOSTAS_EMENDAP (ID_PROPOSTA);
Create Index PROPOSTAS_EMENDA2 on PROPOSTAS_EMENDAP (ID_CONVENIO);
Create Index PROPOSTAS_EMENDA3 on PROPOSTAS_EMENDAP (ID_PROP_PROGRAMA);

