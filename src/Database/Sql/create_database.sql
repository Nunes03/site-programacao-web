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

