create database if not exists uniaservice;

create table if not exists uniaservice.user
(
    id        int auto_increment primary key,
    name      varchar(80) not null,
    last_name varchar(100),
    birthday  date,
    status    varchar(500),
    email     varchar(100) not null unique,
    password  varchar(50)  not null
);

create table if not exists uniaservice.amigos
(
    id        int auto_increment primary key,
    id_user   int not null,
    id_amigo  int not null,
    CONSTRAINT fk_user_id_user FOREIGN KEY (id_user) REFERENCES uniaservice.user(id),
    CONSTRAINT fk_user_id_amigo FOREIGN KEY (id_user) REFERENCES uniaservice.user(id)
);
