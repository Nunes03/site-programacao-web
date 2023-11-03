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
    content text not null,
    user_id int  not null,
    foreign key (user_id)
        references user (id)
);

create table if not exists uniaservice.image_post
(
    id      int auto_increment primary key,
    image   blob not null,
    post_id int  not null,
    foreign key (post_id)
        references post (id)
);
