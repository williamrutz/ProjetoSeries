create table usuario (
id_user serial PRIMARY KEY,
nome varchar(30),
email varchar(30),
login varchar(11),
senha varchar(15));


create table series (
id_serie serial PRIMARY KEY,
nome varchar(30),
sinopse varchar(2000));

create table lista (
id_user int,
id_serie int,
PRIMARY KEY (id_user, id_serie),
FOREIGN KEY (id_user) references usuario(id_user),
FOREIGN KEY (id_serie) references series(id_serie));

create table avaliacao (
id_user int,
id_serie int,
nota numeric(5),
PRIMARY KEY (id_user, id_serie),
FOREIGN KEY (id_user) references usuario(id_user),
FOREIGN KEY (id_serie) references series(id_serie));

create table amigos (
id_user int,
id_useramigo int,
PRIMARY KEY (id_user, id_useramigo),
FOREIGN KEY (id_user) references usuario(id_user),
FOREIGN KEY (id_useramigo) references usuario(id_user));
