


INSERT INTO `user` (`id`, `username`, `role`) VALUES
(1, 'crevette', 'user'),
(2, 'superman', 'user'),
(3, 'admin1', 'admin'),
(4, 'nico', 'user'),
(5, 'Digster France', 'user');


INSERT INTO `artist` (`id`,`stage_name`, `cover_img_url`) VALUES
(1, 'Daft Punk', 'https://e-cdns-images.dzcdn.net/images/artist/f2bc007e9133c946ac3c3907ddc5d2ea/330x330-000000-80-0-0.jpg'),
(2, 'Robert Tepper', 'https://e-cdns-images.dzcdn.net/images/cover/e66b5d3a40f69690c1633afb73cc590c/330x330-000000-80-0-0.jpg'),
(3, 'Survivor', ''),
(4, 'Mount Kimbie', 'https://e-cdns-images.dzcdn.net/images/artist/458cc894e454a40871f69b6933705c8c/330x330-000000-80-0-0.jpg');


INSERT INTO `album` (`id`,`artist_id`, `title`, `cover_img_url`, `release_date`) VALUES
(1, NULL, 'Rocky IV soundtrack', 'https://e-cdns-images.dzcdn.net/images/cover/e66b5d3a40f69690c1633afb73cc590c/330x330-000000-80-0-0.jpg', '2019-07-08 00:00:00'),
(2, 4, 'Carbonated', 'https://e-cdns-images.dzcdn.net/images/cover/35c10a7b5cd6aed40a90f8abecfe3710/330x330-000000-80-0-0.jpg', '2018-12-10 00:00:00');


INSERT INTO `playlist` (`id`,`author_id`, `title`, `created_at`) VALUES
(1, 5, 'Urban Hits', '2019-04-16 00:00:00');



INSERT INTO `podcast` (`id`,`title`, `cover_img_url`) VALUES
(1, "La drole d\'humeur de Pierre-Emmanuel Barré", NULL);



INSERT INTO `track` (`id`, `album_id`, `title`, `duration`, `artist_id`) VALUES
(1, 1, 'Burning Heart', 3.5, 3);




INSERT INTO `notification` (`id`, `creator_id`, `type`, `created_at`, `expired_at`, `description`, `shared_ref`, `shared_id`) VALUES
(1, 3, 'information', '2019-07-10 00:00:00', '2019-08-10 00:00:00', "Vous venez de repasser en mode gratuit. La musique ne s\'arrête pas.", NULL, NULL),
(2, 4, 'recommandation', '2019-07-10 00:00:00', '2019-08-07 00:00:00', NULL, 'track', 1),
(3, 3, 'nouveauté', '2019-07-01 00:00:00', NULL, NULL, 'album', 2),
(4, 5, 'recommandation', '2019-07-09 00:00:00', NULL, 'Que des hits, avec Drake et compagnie !', 'playlist', 1),
(5, 4, 'partage', '2019-07-09 00:00:00', NULL, NULL, 'podcast', 1);


INSERT INTO `notification_user` (`id`,`user_id`, `notification_id`, `seen`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 4, 1, 0),
(4, 1, 3, 0),
(5, 1, 4, 0),
(6, 1, 5, 0),
(7, 2, 3, 0);


INSERT INTO `migration_versions` (`version`,`executed_at`) VALUES
('20190710072709', '2019-07-10 07:28:46'),
('20190710074516', '2019-07-10 07:45:26');
