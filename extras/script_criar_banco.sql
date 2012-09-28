
CREATE TABLE IF NOT EXISTS usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  username varchar(50) NOT NULL,
  senha varchar(30) NOT NULL,
  tipo varchar(20) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS funcionario (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  endereco varchar(50) NOT NULL,
  cpf varchar(30) NOT NULL,
  rg varchar(30) NOT NULL,
  telefone varchar(30),
  cargo varchar(30),
  data_admissao datetime,
  obs text,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS cliente (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  endereco varchar(50),
  cpf varchar(30) NOT NULL,
  rg varchar(30) NOT NULL,
  nasc datetime,
  telefone varchar(30),
  celular varchar(30),
  endereco_trabalho varchar(50),
  telefone_trabalho varchar(30),
  cabelo varchar(30),
  username varchar(30) NOT NULL UNIQUE,
  senha varchar(30) NOT NULL,
  admin boolean,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS produto (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(100) NOT NULL,
  qtde_estoque int,
  qtde_ultima_compra int,
  valor_unitario double NOT NULL,
  marca varchar(50),
  data datetime,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS despesa (
  id int(11) NOT NULL AUTO_INCREMENT,
  tipo varchar(30) NOT NULL,
  total double,
  vencimento datetime,
  data_sistema datetime,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS fornecedor (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(80) NOT NULL,
  endereco varchar(50),
  email varchar(50),
  telefone varchar(30),
  cnpj varchar(30),
  data datetime,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS compra (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao text NOT NULL,
  total double,
  qtde int,
  numero_nota_fiscal varchar(30),
  vencimento datetime,
  nome_representante varchar(50),
  data datetime,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS utensilio (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(80) NOT NULL,
  valor double,
  qtde int,
  data_fabricacao datetime,
  data_recebimento datetime,
  data_evento datetime,
  obs text,
  PRIMARY KEY (id)
);


INSERT INTO cliente (nome, cpf, rg, username, senha, admin) VALUES ('Administrador', '54554', '545454', 'admin', 'admin', true);

