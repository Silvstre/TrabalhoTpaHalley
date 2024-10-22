Create database GE;
use GE;

create table equipamentos (
id int primary key auto_increment not null,
nome varchar (100) not null,
tipo varchar(100) not null,
funcao varchar(100) not null
);

create table usuario(
id int primary key not null auto_increment,
login varchar(90),
senha varchar(90)
);

select * from usuario;
select * from equipamentos;
truncate usuario;
