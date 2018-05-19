-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 19 2018 г., 11:16
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `work`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `date`, `text`) VALUES
(97, 26, '2016-10-08 02:05:58', 'Привет чат!'),
(98, 25, '2016-10-08 02:06:58', 'Привет всем, настроил авто-обновление, чтобы в режиме реального времени отображались сообщения,  вроде все работает.'),
(99, 24, '2016-10-08 02:08:00', 'Pjax is a widget integrating the pjax jQuery plugin.\r\n\r\nPjax only deals with the content enclosed between its begin() and end() calls, called the body content of the widget. By default, any link click or form submission (for those forms with data-pjax attribute) within the body content will trigger an AJAX request. In responding to the AJAX request, Pjax will send the updated body content (based on the AJAX request) to the client which will replace the old content with the new one. The browser&#039;s URL will then be updated using pushState. The whole process requires no reloading of the layout or resources (js, css).\r\n\r\nYou may configure $linkSelector to specify which links should trigger pjax, and configure $formSelector to specify which form submission may trigger pjax.\r\n\r\nYou may disable pjax for a specific link inside the container by adding data-pjax=&quot;0&quot; attribute to this link.\r\n\r\nThe following example shows how to use Pjax with the yii\\grid\\GridView widget so that the grid pagination, sorting and filtering can be done via pjax:'),
(102, 26, '2016-10-08 02:08:57', 'How to change default &#039;No result found&#039; text according to you need in Yii framework\r\nby Bal Singh  on  September 09, 2013  in  Yii\r\nSome time there is need to change the default &quot;No result found&quot; text by your own text, to provide more deep information to the front user. So in Yii framework we can set our custom text message in CGridList and CListView by simply set the value of &quot;emptyText&quot; property. For example to show &quot;We have not found anything related to your query&quot; instead of &quot;No result found&quot; text, see code below'),
(104, 26, '2016-10-08 02:09:26', 'И еще раз'),
(108, 26, '2016-10-08 02:21:25', 'Good'),
(109, 26, '2016-10-08 02:21:48', 'Very Good'),
(110, 24, '2016-10-08 02:22:02', 'Yes youre right'),
(113, 26, '2016-10-09 18:53:14', 'Final'),
(116, 27, '2016-10-10 10:17:48', 'do class');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `img`) VALUES
(24, 'Natr1g', '640ab2bae07bedc4c163f679a746f7ab7fb5d1fa', 'test@test.test', 'default-avatar-plaid-shirt-guy.png'),
(25, 'Рустем', '62ecdef74dd6bd8a45500da00a82bdd5018465ad', 'rus@rus.ru', '223393.PNG'),
(26, 'Google', '5de83374d5d98baae97aa3fbb1d5ace119c99e87', 'rustem2301@inbox.ru', 'Lan-Ha-Bay-4.jpg'),
(27, 'Test', '640ab2bae07bedc4c163f679a746f7ab7fb5d1fa', 'test@test.test', 'full-d1a0b89dd37832fc58efc0175b8caf8d.png'),
(28, 'Test23', '99ebdbd711b0e1854a6c2e93f759efc2af291fd0', 'tt@tt.gsd', 'default.png'),
(29, 'Test123', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'rwr@rfsaf.hfdh', 'default.png'),
(30, 'RUstem', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'rustem2301@INBOX.Ru', 'full-d1a0b89dd37832fc58efc0175b8caf8d.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
