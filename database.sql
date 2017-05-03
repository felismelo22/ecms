SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `content_cat`;
CREATE TABLE `content_cat` (
  `id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content_cat` (`id`, `par_id`, `title`, `description`, `publish`, `created`, `updated`) VALUES
(1, 0, 'Uncategorized', 'this is uncategorized', 1, '2017-05-01 07:33:31', '2017-05-01 07:33:31'),
(2, 0, 'kategori a', 'test', 1, '2017-05-02 06:46:43', '2017-05-02 06:47:42'),
(3, 0, 'kategori b', 'test', 1, '2017-05-02 06:48:14', '2017-05-02 06:48:14'),
(4, 0, 'kategori c', 'test', 1, '2017-05-02 06:49:32', '2017-05-02 06:49:32'),
(5, 0, 'kategori d', '', 1, '2017-05-02 06:52:06', '2017-05-02 06:52:06'),
(6, 1, 'unkategori a', '', 1, '2017-05-02 06:52:23', '2017-05-02 06:52:23'),
(7, 1, 'unkategori b', '', 1, '2017-05-02 06:55:46', '2017-05-02 06:55:46'),
(8, 2, 'kategori a', '', 1, '2017-05-02 07:02:35', '2017-05-02 07:02:35'),
(9, 0, 'testing unpublish', '', 1, '2017-05-03 07:02:08', '2017-05-03 07:02:08');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '5' COMMENT '1=admin, 2=editor, 3=author, 4=contributor, 5=subscriber',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`, `created`, `updated`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'iwan@fisip.net', 1, '2017-04-04 09:55:29', '2017-05-01 06:42:58'),
(2, 'iwan', 'md5(123456)', '', 5, '2017-04-05 08:45:41', '2017-04-05 08:45:41'),
(3, 'fredi', 'md5(123456)', '', 5, '2017-04-05 08:46:49', '2017-04-05 08:46:49'),
(4, 'lina', 'md5(123456)', '', 5, '2017-04-05 08:46:55', '2017-04-05 08:46:55'),
(5, 'pae', 'md5(123456)', '', 5, '2017-04-05 08:47:02', '2017-04-05 08:47:02'),
(6, 'mae', 'md5(123456)', '', 5, '2017-04-05 08:47:07', '2017-04-05 08:47:07'),
(7, 'bue', 'md5(123456)', '', 5, '2017-04-05 08:47:13', '2017-04-05 08:47:13'),
(8, 'bapak', 'md5(123456)', '', 5, '2017-04-05 08:47:19', '2017-04-05 08:47:19'),
(9, 'ulfa', 'md5(123456)', '', 5, '2017-04-05 08:47:25', '2017-04-05 08:47:25'),
(10, 'coba_password', 'e10adc3949ba59abbe56e057f20f883e', '', 5, '2017-04-06 10:18:06', '2017-04-06 10:18:06'),
(11, 'coba', '0cc175b9c0f1b6a831c399e269772661', '', 5, '2017-04-07 08:00:09', '2017-04-07 08:00:09'),
(12, 'iwan', 'e10adc3949ba59abbe56e057f20f883e', '', 5, '2017-04-11 07:30:12', '2017-04-11 07:30:12'),
(13, 'iwan', '13bbf54a6850c393fb8d1b2b3bba997b', '', 5, '2017-04-11 07:31:05', '2017-04-11 07:31:05'),
(14, 'iwan', '13bbf54a6850c393fb8d1b2b3bba997b', '', 5, '2017-04-11 07:31:16', '2017-04-11 07:31:16'),
(15, 'iwan', 'e10adc3949ba59abbe56e057f20f883e', '', 5, '2017-04-11 07:34:24', '2017-04-11 07:34:24'),
(16, 'frediansah', 'e10adc3949ba59abbe56e057f20f883e', '', 5, '2017-05-01 05:53:56', '2017-05-01 05:53:56');


ALTER TABLE `content_cat`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `content_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
