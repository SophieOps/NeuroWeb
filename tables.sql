SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `Answer` (
  `ID` int(11) NOT NULL,
  `FK_simu` int(11) NOT NULL,
  `FK_quest` int(11) NOT NULL,
  `successful` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Question` (
  `ID` int(11) NOT NULL,
  `FK_theme` int(11) NOT NULL,
  `textQuestion` text NOT NULL,
  `answer` tinyint(1) NOT NULL,
  `insertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Simulation` (
  `ID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_simu_numberPhone` int(11) DEFAULT NULL,
  `FK_simu_numberServer` int(11) DEFAULT NULL,
  `FK_User` int(11) NOT NULL,
  `FK_Source` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Source` (
  `ID` int(11) NOT NULL,
  `FK_type` int(11) NOT NULL,
  `IPAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Statuts` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `simulation` tinyint(1) NOT NULL,
  `userStatistics` tinyint(1) NOT NULL,
  `classStatistics` tinyint(1) NOT NULL,
  `question` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Theme` (
  `ID` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `openToSimulation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Type` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `User` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `Answer`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD UNIQUE KEY `I_simu_quest` (`FK_simu`,`FK_quest`) USING BTREE;

ALTER TABLE `Question`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Simulation`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `I_numberPhone` (`FK_simu_numberPhone`),
  ADD UNIQUE KEY `I_numberServer` (`FK_simu_numberServer`);

ALTER TABLE `Source`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Statuts`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD UNIQUE KEY `I_name` (`name`);

ALTER TABLE `Theme`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD UNIQUE KEY `number` (`number`);

ALTER TABLE `Type`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `U_name` (`name`);

ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `I_login` (`login`),
  ADD UNIQUE KEY `I_email` (`email`) USING BTREE;


ALTER TABLE `Answer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Question`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Simulation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Source`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Statuts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Theme`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;