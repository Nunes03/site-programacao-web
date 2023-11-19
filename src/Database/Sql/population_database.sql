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

INSERT INTO uniaservice.post (content, `date`, file_name, likes, user_id) VALUES ('Me sentindo assim hoje', '2023-11-18 17:18:43', 'cachorro3.png', 0, 1);
INSERT INTO uniaservice.post (content, `date`, file_name, likes, user_id) VALUES ('Estilo cachorro KKKKKKKKK', '2023-11-18 22:06:48', 'cachorro1.png', 0, 2);
INSERT INTO uniaservice.post (content, `date`, file_name, likes, user_id) VALUES ('Acho lindo esses cachorros', '2023-11-18 10:16:10', 'cachorro2.png', 0, 3);