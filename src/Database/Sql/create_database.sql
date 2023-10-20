drop database uniaservice;
create database uniaservice;

create table uniaservice.`user` (
    id int auto_increment primary key,
    name varchar(80),
    last_name varchar(100),
    birthday date,
    status varchar(500),
    email varchar(100) unique,
    password varchar(50)
);