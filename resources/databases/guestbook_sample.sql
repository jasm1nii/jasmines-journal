SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guestbook_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE `public` (
  `ID` int(6) UNSIGNED NOT NULL,
  `Parent ID` int(6) UNSIGNED DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Name` varchar(300) NOT NULL DEFAULT 'Anonymous',
  `Email` varchar(300) DEFAULT NULL,
  `Website` varchar(300) DEFAULT NULL,
  `Comment` varchar(3000) NOT NULL,
  `IP Address` varbinary(16) DEFAULT NULL,
  `Moderation Status` enum('Pending','Approved','Blocked') NOT NULL DEFAULT 'Pending',
  `User Privilege` enum('Admin','Guest') NOT NULL DEFAULT 'Guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public`
--

INSERT INTO `public` (`ID`, `Parent ID`, `Date`, `Name`, `Email`, `Website`, `Comment`, `IP Address`, `Moderation Status`, `User Privilege`) VALUES
(1, NULL, '2023-11-18 09:43:08', 'sample user', NULL, '', 'this is a *test comment* that uses commonmark-compliant **markdown formatting!**', NULL, 'Approved', 'Guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `public`
--
ALTER TABLE `public`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Parent ID` (`Parent ID`),
  ADD KEY `Moderation Status` (`Moderation Status`),
  ADD KEY `Email` (`Email`),
  ADD KEY `IP Address` (`IP Address`) USING BTREE,
  ADD KEY `Website` (`Website`),
  ADD KEY `Name` (`Name`),
  ADD KEY `User Privilege` (`User Privilege`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `public`
--
ALTER TABLE `public`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
