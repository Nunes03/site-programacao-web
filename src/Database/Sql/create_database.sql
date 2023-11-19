create database if not exists uniaservice;

create table if not exists uniaservice.user
(
    id              int auto_increment primary key,
    name            varchar(80)  not null,
    last_name       varchar(100),
    birthday        date,
    status          varchar(500),
    photo_file_name varchar(255),
    email           varchar(100) not null unique,
    password        varchar(50)  not null
);

create table if not exists uniaservice.post
(
    id      int auto_increment primary key,
    content text     not null,
    date    datetime not null,
    file_name varchar(255),
    likes int not null default 0,
    user_id int      not null,
    foreign key (user_id)
        references uniaservice.user (id)
);

create table if not exists uniaservice.amigo
(
    id        int auto_increment primary key,
    email_user   varchar(120) not null,
    email_amigo  varchar(120) not null,
    foreign key (email_user)
        references uniaservice.`user`(email),
    foreign key (email_amigo)
        references uniaservice.`user`(email)
);