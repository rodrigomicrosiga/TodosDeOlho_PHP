use conveniomysql;

select 'Criando tabela de LOG de Acessos' AS '';

CREATE TABLE IF NOT EXISTS LOGSITE (
ACESSO 		datetime ,
SESSION  	varchar(32) 	not null,
CLIENTIP	varchar(45) 	not null,
HOST            varchar(64) 	not null,
URL 		varchar(128) 	not null,
USERAGENT 	varchar(384) 	not null,
LANGUAGE        varchar(64) 	not null,
QUERYSITE       varchar(256)    
);

