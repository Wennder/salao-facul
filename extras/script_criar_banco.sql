
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

CREATE TABLE IF NOT EXISTS venda (
	id int(11) primary key NOT NULL AUTO_INCREMENT,
	cliente_id int  not null references cliente(id),
	data datetime not null,
	total double,
	total_pago double,
  	obs text NOT NULL
);

CREATE TABLE IF NOT EXISTS produto_venda (
	produto_id int NOT NULL references produto(id),
	venda_id int NOT NULL references venda(id),
	qtde int not null,
	primary key (produto_id, venda_id)
);

CREATE TABLE IF NOT EXISTS servico_venda (
	servico_id int NOT NULL references servico(id),
	venda_id int NOT NULL references venda(id),
	qtde int not null,
	primary key (servico_id, venda_id)
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

CREATE TABLE servico (
	id int primary key not null auto_increment,
	descricao varchar(80) not null,
	horas int not null,
	valor double
);

CREATE TABLE configuracao (
	id int primary key not null auto_increment,
	nome_empresa varchar(80),
	telefone varchar(30),
	email varchar(80),
	percentual_padrao double
);

CREATE TABLE despesa (
	id int primary key not null auto_increment,
	mes varchar(3),
	ano int,
	tipo varchar(80),
	valor double,
	data datetime
);

CREATE TABLE agendamento (
	id int primary key not null auto_increment,
	cliente_id int  not null references cliente(id),
	dia date not null,
	inicio varchar(20) not null,
	duracao int
);

CREATE TABLE agendamento_servico (
	id_agendamento int  not null references agendamento(id),
	id_servico int not null references servico(id),
	primary key (id_agendamento, id_servico)
);


INSERT INTO cliente (nome, cpf, rg, username, senha, admin) VALUES ('Administrador', '54554', '545454', 'admin', 'admin', true);
INSERT INTO cliente (nome, cpf, rg, username, senha, admin) VALUES ('Toni Santes', '54554', '545454', 'toni', '12345', false);

