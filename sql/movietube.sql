-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2022 at 02:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movietube`
--

-- --------------------------------------------------------

--
-- Table structure for table `download_link`
--

CREATE TABLE `download_link` (
  `LinkID` int(11) NOT NULL,
  `MovieID` int(11) NOT NULL,
  `Resolution` int(11) DEFAULT NULL,
  `Video_format` varchar(30) DEFAULT NULL,
  `Link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `download_link`
--

INSERT INTO `download_link` (`LinkID`, `MovieID`, `Resolution`, `Video_format`, `Link`) VALUES
(4, 1, 1080, 'BluRay', 'magnet:?xt=urn:btih:C196F2EF2EE4BFF12FB75F353503F269BF92C5B6&dn=Jumanji%3A+Welcome+to+the+Jungle+%282017%29+1080p+WEB-DL+6CH+1.9GB&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.dler.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fopentracker.i2p.rocks%3A6969%2Fannounce&tr=udp%3A%2F%2F47.ip-51-68-199.eu%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.internetwarriors.net%3A1337%2Fannounce&tr=udp%3A%2F%2F9.rarbg.to%3A2920%2Fannounce&tr=udp%3A%2F%2Ftracker.pirateparty.gr%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.cyberia.is%3A6969%2Fannounce');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `Tag` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`Tag`) VALUES
('Action'),
('Adventure'),
('Animation'),
('Comedy'),
('Drama'),
('Family'),
('Horror'),
('Sci-Fi'),
('Sport');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `MovieID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(1500) NOT NULL,
  `Year` int(11) NOT NULL,
  `YoutubeLink` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`MovieID`, `Title`, `Description`, `Year`, `YoutubeLink`) VALUES
(1, 'Jumanji: Welcome to the Jungle', 'In 1996 Brantford, New Hampshire, teenager Alex Vreeke is given the Jumanji board game by his father, who found it on a beach. Uninterested, he sets the game aside. That night, it transforms into a video-game cartridge that catches Alex\'s attention when the Jumanji drumbeats awaken him. When he begins playing it, he disappears into the game. 20 years later, four students at Brantford High are sentenced to detention: Spence Gilpin and his former friend Anthony \"Fridge\" Johnson for cheating, Bethany Walker for making a phone call during an English test, and Martha Kaply for refusing to participate in gym class and insulting her teacher. In the school basement, where they are serving their detention, Fridge discovers Alex\'s discarded video-game system, and he and Spencer decide to play. Although it has five playable characters, they are unable to select the first one, so they choose two others, and convince the girls to play as the remaining two. When Spencer presses \"Start\", they are transported into the game.', 2017, 'https://www.youtube.com/embed/2QKg5SZ_35I'),
(2, 'Uncharted', 'Street-smart Nathan Drake (Tom Holland) is recruited by seasoned treasure hunter Victor \"Sully\" Sullivan (Mark Wahlberg) to recover a fortune amassed by Ferdinand Magellan and lost 500 years ago by the House of Moncada. What starts as a heist job for the duo becomes a globe-trotting, white-knuckle race to reach the prize before the ruthless Santiago Moncada (Antonio Banderas), who believes he and his family are the rightful heirs. If Nate and Sully can decipher the clues and solve one of the world\'s oldest mysteries, they stand to find $5 billion in treasure and perhaps even Nate\'s long-lost brother...but only if they can learn to work together.', 2022, 'https://www.youtube.com/embed/eHp3MbsCbMg'),
(3, 'Spider-man 2', 'On the verge of a nervous breakdown, Peter Parker, now studying physics at the University of Columbia, learns the hard way that life has just got tougher. It\'s been two short years since Norman Osborn\'s death in Spider-Man (2002), and Mary Jane is now giving up on Peter and Aunt May faces imminent foreclosure. As Parker tries to find his feet, uncertain of whether he wants to be a crime-fighter or not, a freak accident in the name of science gives birth to a new super-villain: the obsessed, multi-tentacled mad scientist, Doc Ock. This time, when the world most needs him, Peter must choose between remaining faithful to his calling or staying away from Mary Jane, the girl of his dreams. Will Peter Parker embrace his destiny as Spider-Man, New York City\'s defender?', 2004, 'https://www.youtube.com/embed/3jBFwltrxJw'),
(4, 'A Series of Unfortunate Events', 'After the tragic death of their parents, Violet (Emily Browning), Klaus (Liam Aiken), and Sunny Baudelaire (Kara and Shelby Hoffman) travel from guardian to guardian by a good friend of their parents, Mr. Poe (Timothy Spall). The orphans stay with herpetologist Montgomery Montgomery (Sir Billy Connolly) and grammar-wise Josephine Anwhistle (Meryl Streep), but the worst one was Count Olaf (Jim Carrey), an evil and greedy man, who, with the help of his assistants, Bald Man (Luis Guzmán), Hook-Handed Man (Jamie Harris), Person of Indeterminate Gender (Craig Ferguson), and the two white-faced women (Jennifer Coolidge and Jane Adams), tries to steal the Baudelaire fortune. To do this, he disguises himself in the forms of assistant Stephano and ship Captain Julio Sham.', 2004, 'https://www.youtube.com/embed/TwSHmixSVao'),
(5, 'The Hunger Games', 'In order to control future rebellions by remembering the past rebellion, the Powers That Be of the dystopian society of Panem force two youngsters from each of the twelve districts to participate in The Hunger Games. The rules are very simple: the twenty-four players must kill each other and survive in the wilderness until only one remains. The games are broadcast through the Capital and the twelve districts to entertain and intimidate the population. In District 12, teenager Katniss Everdeen is a great hunter and archer. When her younger sister, Primrose Everdeen, is selected as one of the \"tributes\" of their district, Katniss volunteers to take her place in the games. Together with Peeta Mellark, they head by train to the Capital to be prepared for the brutal game.', 2012, 'https://www.youtube.com/embed/mfmrPu43DF8'),
(6, 'High School Musical', 'Popular basketball player Troy Bolton and Ms.-Einstein Gabriella Montez meet at a ski resort over winter break and are forced to sing karaoke together on New Year\'s Eve; afterwards they exchange numbers. When Troy returns to East High in Albuquerque, New Mexico, surprise. Gabriella is a new classmate. They become friends quickly and decide to audition for the Winter Musical together. They get callbacks and arouse the ire of drama queen Sharpay Evans and her brother Ryan. Troy\'s friend Chad becomes afraid that Troy will become distracted from the basketball championship. Gabriella\'s friend Taylor will do anything to get her on the Decathlon team. Chad and Taylor decide to film Troy saying Gabriella isn\'t important after Chad tricks him into saying it. Taylor shows the video to Gabriella, who refuses to do the callbacks with Troy. Meanwhile, Sharpay and Ryan manipulate the callbacks to the same time as the championship game.\r\n\r\n', 2006, 'https://www.youtube.com/embed/zL4ZEWYsmuw'),
(7, 'Avengers: Endgame', 'After half of all life is snapped away by Thanos, the Avengers are left scattered and divided. Now with a way to reverse the damage, the Avengers and their allies must assemble once more and learn to put differences aside in order to work together and set things right. Along the way, the Avengers realize that sacrifices must be made as they prepare for the ultimate final showdown with Thanos, which will result in the heroes fighting the biggest battle they have ever faced.', 2019, 'https://www.youtube.com/embed/TcMBFSGVi1c'),
(8, 'Creed', 'Adonis Johnson lost his mother when he was young and would get into constant trouble and end up in foster care or juvenile detention. One day a woman goes to see him and tells him that her late husband is his father. And her husband\'s boxing great, Apollo Creed. She would take him in and educate him but he feels the need to be a boxer like his father. So he moves to Philadelphia and approaches Rocky Balboa and asks Rocky to train him. Rocky tries to talk him out of it but it\'s something he needs to do. Eventually Rocky offers to train him and when he beats a great boxer and his connection to Apollo is revealed, he is offered a chance to fight a world champion and all he needs to do is take the name Creed.', 2015, 'https://www.youtube.com/embed/Uv554B7YHk4'),
(26, 'Chip \'n Dale: Rescue Rangers', 'Thirty years after their popular television show ended, chipmunks Chip and Dale live very different lives. When a cast member from the original series mysteriously disappears, the pair must reunite to save their friend.', 2022, 'https://www.youtube.com/embed/F4Z0GHWHe60'),
(27, 'Morbius', 'Dangerously ill with a rare blood disorder, and determined to save others suffering his same fate, Dr. Morbius attempts a desperate gamble. What at first appears to be a radical success soon reveals itself to be a remedy potentially worse than the disease.', 2022, 'https://www.youtube.com/embed/oZ6iiRrz1SY'),
(30, 'The Lord of the Rings: The Fellowship of the Ring', 'An ancient Ring thought lost for centuries has been found, and through a strange twist of fate has been given to a small Hobbit named Frodo. When Gandalf discovers the Ring is in fact the One Ring of the Dark Lord Sauron, Frodo must make an epic quest to the Cracks of Doom in order to destroy it. However, he does not go alone. He is joined by Gandalf, Legolas the elf, Gimli the Dwarf, Aragorn, Boromir, and his three Hobbit friends Merry, Pippin, and Samwise. Through mountains, snow, darkness, forests, rivers and plains, facing evil and danger at every corner the Fellowship of the Ring must go. Their quest to destroy the One Ring is the only hope for the end of the Dark Lords reign.', 2001, 'https://www.youtube.com/embed/V75dMMIW2B4'),
(31, 'The Lord of the Rings: The Two Towers', 'The Fellowship has been broken. Boromir is dead, Frodo Baggins and Samwise Gamgee have gone to Mordor alone to destroy the One Ring, Merry and Pippin have been captured by the Uruk-hai, and Aragorn, Legolas, and Gimli have made friends of the Rohan, a race of humans that are in the path of the upcoming war, led by its aging King, Théoden. The two towers between Mordor and Isengard, Barad-dûr and Orthanc, have united in their lust for destruction. The corrupt wizard Saruman, under the power of the Dark Lord Sauron, and his slimy assistant, Gríma Wormtongue, have created a grand Uruk-hai army bent on the destruction of Man and Middle-earth. The rebellion against Sauron is building up and will be led by Gandalf the White, who was thought to be dead after the Balrog captured him. One of the Ring&#039;s original bearers, the creature Gollum, has tracked Frodo and Sam down in search of his &quot;precious&quot;, but is captured by the Hobbits and used as a way to lead them to Mt. Doom. The War of the Ring has now begun.', 2002, 'https://www.youtube.com/embed/LbfMDwc4azU'),
(32, 'The Lord of the Rings: The Return of the King', 'The War of the Ring reaches its climax as the Dark Lord Sauron sets his sights on Minas Tirith, the capital of Gondor. The members of the Fellowship in Rohan are warned of the impending attack when Pippin cannot resist looking into Saruman&#039;s palantír and is briefly contacted by the Dark Lord. King Théoden is too proud to send his men to help without being asked, so Gandalf and Pippin ride to Minas Tirith to see that this request is sent. They meet opposition there from Denethor, Steward of the city and father of Faramir and the late Boromir. Denethor&#039;s family has acted as temporary guardians of Gondor for centuries until a member of the true line of Kings returns. This member is none other than Aragorn, who must overcome his own self-doubt before he can take on the role he was destined to fulfill. Meanwhile, Frodo and Sam continue to carry the One Ring towards Mordor, guided by Gollum. What they don&#039;t know is that Gollum is leading them into a trap so that he can reclaim the Ring for himself. Though Sam suspects his deceit, Frodo is starting to be corrupted by the Ring&#039;s power and the mistrust of Sam this causes is fully exploited by Gollum. The only way good can prevail in this contest is if the Ring is destroyed, an event that is becoming harder every minute for Frodo to achieve. The fate of every living creature in Middle-earth will be decided once and for all as the Quest of the Ringbearer reaches its climax.', 2003, 'https://www.youtube.com/embed/r5X-hFf6Bwo'),
(33, 'It', 'Undoubtedly, something is going on in the once-peaceful late-1980s town of Derry, Maine, as a seemingly endless string of violence, murder, and unaccountable child disappearances terrorise the small community. Against the backdrop of anguished remorse after the recent death of the innocent six-year-old, Georgie Denbrough, the close-knit band of school pariahs, or The Losers&#039; Club--Georgie&#039;s troubled older brother, Bill; the bullied new classmate, Ben Hanscom; the ill-treated, Beverly Marsh; the playful, Richie Tozier; home school kid, Mike Hanlon; the asthmatic, Eddie Kaspbrak; and the fastidious, Stanley Uris--pluck up the courage to confront their well-hidden childhood fears and the blood-curdling clown-like shape-shifter who lives in their twisted visions. Nevertheless, is the malevolent bright-eyed demon, indeed, the nightmarish creature that horrifies Derry? Either way, the otherworldly entity needs to feed, and the young team of defenders are no match for him. Do they have what it takes to face IT?', 2017, 'https://www.youtube.com/embed/hAUTdjf9rko');

-- --------------------------------------------------------

--
-- Table structure for table `movie_has_genre`
--

CREATE TABLE `movie_has_genre` (
  `MovieID` int(11) NOT NULL,
  `Tag` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_has_genre`
--

INSERT INTO `movie_has_genre` (`MovieID`, `Tag`) VALUES
(1, 'Action'),
(1, 'Adventure'),
(1, 'Comedy'),
(2, 'Action'),
(2, 'Adventure'),
(3, 'Action'),
(3, 'Adventure'),
(3, 'Sci-Fi'),
(4, 'Adventure'),
(4, 'Comedy'),
(4, 'Family'),
(5, 'Action'),
(5, 'Adventure'),
(5, 'Sci-Fi'),
(6, 'Comedy'),
(6, 'Drama'),
(6, 'Family'),
(7, 'Action'),
(7, 'Adventure'),
(7, 'Drama'),
(8, 'Action'),
(8, 'Drama'),
(8, 'Sport'),
(26, 'Adventure'),
(26, 'Animation'),
(26, 'Comedy'),
(27, 'Action'),
(27, 'Adventure'),
(27, 'Horror'),
(30, 'Action'),
(30, 'Adventure'),
(30, 'Drama'),
(31, 'Action'),
(31, 'Adventure'),
(31, 'Drama'),
(32, 'Action'),
(32, 'Adventure'),
(32, 'Drama'),
(33, 'Action'),
(33, 'Drama'),
(33, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL,
  `MovieID` int(11) NOT NULL,
  `Comment` varchar(1000) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `MovieID`, `Comment`, `UserID`, `Rating`) VALUES
(1, 1, 'Kevin Hart and Dwayne Johnson are funny af !', 3, 5),
(2, 1, 'Amazing movie, really enjoyed ! Tho must say, the original Jumanji series were much better.', 2, 4.5),
(3, 1, 'where did this comment go', 2, 5),
(7, 1, 'A lot of the goodwill surrounding this reboot/long-time-coming sequel is thanks to The Rock, who gives an exemplary - and very funny - performance as a nerdish teenager trapped in a hulking action man\'s body. The rest is merely so-so by Hollywood standards, but at least it\'s inoffensive and fast-paced, so there\'s little to dislike. Just not too much to love either.\r\n\r\nCompared to the original JUMANJI, this one has been updated a little to the video game era, and I did like the old nod to Atari. The plotting is one of the worst things about this, with a generic, barely-glimpsed villain and random action scenes utilising barely-impressive CGI animal effects. Of the cast, Kevin Hart is quite funny, but I found Jack Black bland and Karen Gillan to be completely out of her depth; the obvious doubling in every one of her fight scenes also gets to be a little much.', 2, 5),
(8, 1, 'What about this comment ???', 2, 5),
(9, 1, 'Zanko is here to comment on your moviee', 5, 5),
(11, 1, 'Hello, admin here', 1, 5),
(12, 33, 'Movie is really scarry, now i have clownphobiaaaaaaaaaaaaaaaaa :(', 2, 5),
(13, 33, 'I have clownphobia as well now....', 5, 5),
(14, 33, 'And another bites the dust', 5, 5),
(15, 33, 'I decided to rewatch it', 2, 5),
(16, 33, 'another try at the comment section', 2, 5),
(17, 33, 'doesnt work does it now', 2, 5),
(25, 33, 'itt worksssss, lets gooooooooooooooo', 2, 5),
(26, 32, 'Wow i loved this movie, i think it might be on of the best movie series out there. Can\'t wait to watch The twin towers next !!!', 8, 5),
(27, 1, 'Moj prvi komentar', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(1000) NOT NULL,
  `Role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Email`, `Password`, `Role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$2moU2R0t4hPv7ss60H/TTuD4NFthqD4w.jUJMyz2hxCMq70fujJwG', 'admin'),
(2, 'daniel123', 'daniel123@gmail.com', '$2y$10$9UMFSuFzxc8L30Ga4vL3UuwuOYvD16L5yzu4V8qTw5v0zW97wM0eO', 'user'),
(3, 'lil dickey', 'lildickey@gmail.com', '$2y$10$iTfjRGsyVcTo8QbHx4ZAGuquiNZwQXyUD2FFhJHoY2629qx3ch2Wa', 'user'),
(4, 'mongo', 'mongo@gmail.com', '$2y$10$dMEw0Vy/Vu7IEjCCmh9x../X5a.H0kPqJ3RoMdu72oa5NFwhzRTiq', 'user'),
(5, 'zanko', 'zanko@gmail.com', '$2y$10$gVfktW.CiWQ.IbUM5Qlv6uTUaAVbFgDON7/LK3LayJ8elXl7wzogS', 'user'),
(7, 'marjan', 'marjan@gmail.com', '$2y$10$8iaOPBkbrFprd0a/kZGDdu2uCaq..qdpJWkG8fHA8YhkLVgjGHCCW', 'user'),
(8, 'david', 'david@gmail.com', '$2y$10$sXpkcm5EMbPJ1csn4Uw5o.mSfCzEjLyteAVa0o.rDO35zJkSYaZVK', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `download_link`
--
ALTER TABLE `download_link`
  ADD PRIMARY KEY (`LinkID`),
  ADD KEY `FK_59` (`MovieID`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`Tag`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`MovieID`);

--
-- Indexes for table `movie_has_genre`
--
ALTER TABLE `movie_has_genre`
  ADD PRIMARY KEY (`MovieID`,`Tag`),
  ADD KEY `FK_50` (`MovieID`),
  ADD KEY `FK_53` (`Tag`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `FK_62` (`UserID`),
  ADD KEY `FK_68` (`MovieID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `download_link`
--
ALTER TABLE `download_link`
  MODIFY `LinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `movie_has_genre`
--
ALTER TABLE `movie_has_genre`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `download_link`
--
ALTER TABLE `download_link`
  ADD CONSTRAINT `FK_57` FOREIGN KEY (`MovieID`) REFERENCES `movie` (`MovieID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_has_genre`
--
ALTER TABLE `movie_has_genre`
  ADD CONSTRAINT `FK_48` FOREIGN KEY (`MovieID`) REFERENCES `movie` (`MovieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_51` FOREIGN KEY (`Tag`) REFERENCES `genre` (`Tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_60` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_66` FOREIGN KEY (`MovieID`) REFERENCES `movie` (`MovieID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
