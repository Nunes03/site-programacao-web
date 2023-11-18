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

INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Suyanne', 'Candido', '2003-11-08', NULL, 'fotoSuy.png', 'suyannecandido@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Lucas', 'Nunes', '2003-11-08', NULL, 'fotoLucas.png', 'lucasnunes@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Marcelo', 'Schaefer', '2003-11-08', NULL, 'fotoMarcelo.png', 'marceloschaefer@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Everton', 'Cruz', '2003-11-08', NULL, 'fotoEverton.png', 'evertoncruz@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Benicio', 'Peixoto', '2003-11-08', NULL, 'imagempessoa1.png', 'beniciopeixoto@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Bruno', 'Moraes', '2003-11-08', NULL, 'imagempessoa2.png', 'brunomoraes@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Alexandre', 'Julio', '2003-11-08', NULL, 'imagempessoa3.png', 'alexandrejulio@gmail.com', '123');
INSERT INTO `uniaservice`.`user` (`id`, `name`, `last_name`, `birthday`, `status`, `photo_file_name`, `email`, `password`) VALUES (NULL, 'Sebastiao', 'Jesus', '2003-11-08', NULL, 'imagempessoa4.png', 'sebastiaojesus@gmail.com', '123');

INSERT INTO `uniaservice`.`amigo` (`id`, `email_user`, `email_amigo`) VALUES (NULL, 'evertoncruz@gmail.com', 'suyannecandido@gmail.com');
INSERT INTO `uniaservice`.`amigo` (`id`, `email_user`, `email_amigo`) VALUES (NULL, 'evertoncruz@gmail.com', 'lucasnunes@gmail.com');
INSERT INTO `uniaservice`.`amigo` (`id`, `email_user`, `email_amigo`) VALUES (NULL, 'evertoncruz@gmail.com', 'marceloschaefer@gmail.com');