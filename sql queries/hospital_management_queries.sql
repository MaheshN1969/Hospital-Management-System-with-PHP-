-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2020 at 04:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `app_id` int(11) NOT NULL,
  `doctor_id` int(11) UNSIGNED NOT NULL,
  `patient_id` int(11) NOT NULL,
  `app_date` date NOT NULL,
  `app_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_id`, `doctor_id`, `patient_id`, `app_date`, `app_time`) VALUES
(35, 30, 5, '2020-10-13', 16),
(46, 48, 1, '2020-10-13', 19),
(47, 48, 3, '2020-10-14', 18);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `doctor_id` int(11) UNSIGNED NOT NULL,
  `issue_date` date NOT NULL,
  `pay_date` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `pat_id`, `doctor_id`, `issue_date`, `pay_date`, `amount`) VALUES
(31, 1, 48, '2020-10-13', '2020-10-13', 700);

-- --------------------------------------------------------

--
-- Stand-in structure for view `bill_view`
-- (See below for the actual view)
--
CREATE TABLE `bill_view` (
`bill_id` int(11)
,`pat_full_name` varchar(62)
,`Gender` varchar(20)
,`doc_full_name` varchar(77)
,`specialization` varchar(30)
,`issue_date` date
,`pay_date` date
,`amount` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `middle_name` varchar(25) NOT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `gender` enum('M','F','T') NOT NULL,
  `dob` date NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `specialization` varchar(30) NOT NULL,
  `contact_no` bigint(20) UNSIGNED NOT NULL,
  `email_id` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pincode` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(128) NOT NULL,
  `verified` int(11) DEFAULT 0,
  `join_date` date DEFAULT cast('0000-00-00' as date),
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `age`, `specialization`, `contact_no`, `email_id`, `address`, `city`, `state`, `pincode`, `username`, `verified`, `join_date`, `password`) VALUES
(2, 'Tom', 'Robot', 'Sr.', 'F', '1980-06-16', 31, 'MBBS', 9102302321, 'tom1980@gmail.com', 'Austrellia, New York, Pakistan', 'Mumbai', 'Maharashtra', 401209, 'tom.sr@hosp.com', 1, '2020-10-13', 'tom@1980'),
(21, 'Navneet', 'Pandurang', 'Davang', 'T', '2001-02-07', 19, 'Orthopedic', 1321554645, 'abcd@gmail.com', 'Ambegoan Bk.', 'Pune', 'Maharashtra', 411046, 'navneet.davang@hospital.com', 0, NULL, 'n1234567'),
(30, 'Pandurang', 'Ganpati', 'Davang', 'M', '2001-07-18', 19, 'Dentist', 8888777720, 'xyz.pqr@gmail.com', 'Kataraj', 'Sangli', 'Keral', 412025, 'pandurang.davang@hospital.com', 0, NULL, '1234567890'),
(43, 'Navneet', 'XYZ', 'Davang', 'F', '2020-09-05', 0, 'Pediatrician', 1234567890, 'abcd@gmail.com', 'Ambegoan Bk.', 'Pune', 'Maharashtra', 411046, 'navneet.davang.5613@hospital.com', 0, NULL, 'abcdefghi'),
(45, 'abcasd', 'def', 'ghi', 'F', '2020-02-12', 0, 'ENT', 9874563210, 'slfjkjsd@1234.com', 'Kothrud', 'Pune', 'Madhya Pradesh', 147852, 'abcasd.ghi@hospital.com', 0, NULL, 'hello@1234'),
(46, 'Navneet', 'Pandurang', 'Davang', 'T', '2002-06-15', 18, 'Dermatologist', 1321554645, 'abcd@gmail.com', 'Ambegoan Bk.', 'Pune', 'Maharashtra', 411046, 'navneet.davang.683@hospital.com', 0, NULL, 'navneet@1234'),
(47, 'Jayesh', 'ABC', 'Burande', 'M', '2000-10-02', 20, 'ENT', 4567891230, 'jayeshburande@gmail.com', 'I doeelsjkdflk sdjfklsjd', 'Parbhani', 'Maharashtra', 412045, 'jayesh.burande@hospital.com', 0, NULL, 'jayesh@2002'),
(48, 'Mahesh', 'Sunil', 'Narayankar', 'M', '2004-02-11', 16, 'Orthopedic', 4578963210, 'mahesh@gmail.com', 'Vimanagar, Satara Road', 'Pune', 'Maharashtra', 421530, 'mahesh.narayankar@hospital.com', 1, '2020-10-13', 'mahesh@2000');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `Patient_ID` int(11) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Blood_Group` varchar(3) NOT NULL,
  `Date_of_Birth` varchar(10) NOT NULL,
  `Age` int(3) NOT NULL,
  `Contact_No` varchar(10) NOT NULL,
  `Email_ID` varchar(40) NOT NULL,
  `Postal_Address` varchar(100) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Pin_Code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Patient_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Username`, `Password`, `Gender`, `Blood_Group`, `Date_of_Birth`, `Age`, `Contact_No`, `Email_ID`, `Postal_Address`, `City`, `State`, `Pin_Code`) VALUES
(1, 'Dheeren', 'Hemant', 'Chirmade', 'dheeren.chirmade@hospital.com', 'dheeren@2000', 'male', 'B+', '2000-10-05', 20, '9518556456', 'dheerenchirmade1184@gmail.com', 'karvenagar', 'Pune', 'Maharashtra', '411038'),
(2, 'ABC', 'XYZ', 'PQR', 'abc.pqr@hospital.com', 'abcd1234', 'male', 'AB-', '2005-07-11', 15, '1234567890', 'abcd@gmail.com', 'i dont konos', 'pune', 'Maharashtra', '411046'),
(3, 'Akhilesh', 'ABC', 'Shaji', 'akhilesh.shaji@hospital.com', 'akhilesh@123', 'male', 'O+', '2000-02-02', 20, '9642987512', 'gknightrider222@gmail.com', '58 RCC,Thana Mandi Rajouri', 'Rajouri', 'Jammu and Kashmir', '555555'),
(4, 'Sahil', 'Anil', 'Chouwdhary', 'sahil.chouwdhary@hospital.com', 'sahil@123', 'male', 'AB+', '2000-08-11', 20, '9402268224', 'Sahilcjow008222@gmail.com', 'C/O 53BTL BSF campus ,Thana Mandi Rajouri', 'Rajouri', 'Jammu and Kashmir', '555554'),
(5, 'Lisa', 'ABC', 'Chakraborty', 'lisa.chakraborty@hospital.com', 'Lisa@123', 'female', 'AB+', '2000-11-18', 19, '9642987512', 'lisafbabe@gmail.com', '47 BRTF,Khandli Bridge Rajouri', 'Rajouri', 'Jammu and Kashmir', '555553'),
(6, 'Rutik', 'Ramesh', 'Kadam', 'rutik.kadam@hospital.com', 'rkadam@123', 'male', 'O+', '2000-11-08', 20, '9642954564', 'rkadam@gmail.com', 'Ant of Hill,Wadala,Mumbai 34', 'Mumbai', 'Maharashtra', '412534'),
(7, 'Rushab', 'Ramesh', 'Kadam', 'rushab.kadam@hospital.com', 'rkadam@123', 'male', 'O+', '1995-11-08', 20, '9642954564', 'rkadam@gmail.com', 'Ant of Hill,Wadala,Mumbai 34', 'Mumbai', 'Maharashtra', '412534'),
(8, 'Sunita', 'Ramesh', 'Kadam', 'sunita.kadam@hospital.com', 'sunitak@123', 'female', 'AB+', '1969-02-09', 47, '9642954564', 'rkadam@gmail.com', 'Ant of Hill,Wadala,Mumbai 34', 'Mumbai', 'Maharashtra', '412534'),
(9, 'Ayon', 'Santosh', 'Das', 'ayon.das@hospital.com', 'addas@123', 'male', 'A+', '2000-07-24', 20, '9644656474', 'addas009@gmail.com', 'Plot no C5,Fancy market,Kalimpong', 'Gangtok', 'Sikkim', '431987'),
(10, 'Sidhart', 'ABC', 'Rathod', 'sidhart.rathod@hospital.com', 'rowdyrathod@123', 'male', 'B+', '2000-06-17', 20, '9643144944', 'rowdyhero2@gmail.com', 'Tundae Kabab gali,old Lucknow', 'Locknow', 'Uttar Pradesh', '497882');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `record_name` varchar(128) NOT NULL,
  `data` blob NOT NULL,
  `record_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `pat_id`, `record_name`, `data`, `record_date`) VALUES
(12, 1, 'Orthopedic_13 Oct 2020_16.27:06.pdf', 0x255044462d312e330a332030206f626a0a3c3c2f54797065202f506167650a2f506172656e742031203020520a2f5265736f75726365732032203020520a2f436f6e74656e74732034203020523e3e0a656e646f626a0a342030206f626a0a3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203539363e3e0a73747265616d0a789c9d944d6fd3401086effe157304a12efb6d3b37d24000a9a43416f795bd4d4cfd116c57a8fc7ad65e27bb09218a7b196964cd3bcfcebc1e0a5f038c4408bf837902ef3f11a01c610cc9237c4ccc975812f063b3096884980021258a1984914024861b4e91a0d06878845f806103468db118310c824588879064f0e64e6779aa0a78d069dd646f21f969bac0f780a28819026c3a63b0910cf16119d018851284c1e2044a88084584edf302d67b6e227deee145566919104fd146f30c8749fa17f0d8f4b194df54a91ddb204f8fe40fa524a288857eed0c165bad1b5dc1675daaaa83db6dde942a3b1524e70505e9997dc1a5ae32dd5c8723a5794a748c53aae272efd7cc2a2488d3a1c187cdc451b9d219503c6d2aae765ed47506cba67ede4d1b8ddf7efeced56214620a7e3c588f8b1851eaac37e6bdf5f643bb043f8eccfc35311e1a2f1a04d32de6ea6770a7b6baddc2fab9ca0b23d5a817553da953935ce6c166ef72d05bef749aab22ffa3babcaea651399519ac9a6e5beffa3f7cda569dc64275574e65bf4ebfbf59cd2aed8ca97c5b61c48793e262bf577b6eec7a5934dcb3c37ac7fccc7a29beea323269f4f9e5cb181324b039900289c83e5d772a2f5a074e8c090d23194fa20c2313a97f12c73e0edce616fc8c9b8fcffc056f304c10e3d61b2fe5aeabcbf64a57708670e4d7dfae7e7c59dc90d83bf5033b35038843c73ee6ff39e7277c3464c337a37fdfe8366df25defdc6990be88f98352dde9b22ee01f50c990f47efe31bf12947324851de4f366a3db57603a89443d69e3a3b69b62126a2c46238fdfe63dff5fc669caba0a656e6473747265616d0a656e646f626a0a312030206f626a0a3c3c2f54797065202f50616765730a2f4b696473205b3320302052205d0a2f436f756e7420310a2f4d65646961426f78205b302030203834312e3839203539352e32385d0a3e3e0a656e646f626a0a352030206f626a0a3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203336343e3e0a73747265616d0a789c5d52cb6e833010bcf3153ea687084c1a82258444499038f4a1d27e008125452a061972e0efbbbb76d2aa4858e3b16776566b3f2f8fa5ee17e1bf99b1a960115daf5b03f378350d88335c7aedc950b47db3b81dafcd504f9e8fe26a9d17184add8d5e92f8ef78362f66159bac1dcff0e0f9afa605d3eb8bd87ce615eeabeb347dc3007a118197a6a2850e7d9eebe9a51e40f82cdb962d9ef7cbba45cdef8d8f750211f25eda2ccdd8c23cd50d985a5fc04b8220154951a41ee8f6df596415e7eeefd543814b805fea257184383ee0120621114a2256211332266247c4a325722248a2ac44ee90c85c7d32454c316e05a5ba0568be6a83e5029665e413bb2219612a1248ac8bd8d53a11dedb6411e198ee843963c5fc8e5bc8581b317eb2bc229c33bf67cf13e3c391f23b4fe295f53c725fec292def3c2561e7493995f3a4b695f3a49caab03876dd73b7340e7a30f73937576370c4fcaa78b634d55ec3fde14de3442afa7f007f0db6a90a656e6473747265616d0a656e646f626a0a362030206f626a0a3c3c2f54797065202f466f6e740a2f42617365466f6e74202f54696d65732d426f6c640a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f546f556e69636f64652035203020520a3e3e0a656e646f626a0a372030206f626a0a3c3c2f54797065202f466f6e740a2f42617365466f6e74202f54696d65732d526f6d616e0a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f546f556e69636f64652035203020520a3e3e0a656e646f626a0a322030206f626a0a3c3c0a2f50726f63536574205b2f504446202f54657874202f496d61676542202f496d61676543202f496d616765495d0a2f466f6e74203c3c0a2f46312036203020520a2f46322037203020520a3e3e0a2f584f626a656374203c3c0a3e3e0a3e3e0a656e646f626a0a382030206f626a0a3c3c0a2f50726f647563657220284650444620312e3832290a2f4372656174696f6e446174652028443a3230323031303133313632373036290a3e3e0a656e646f626a0a392030206f626a0a3c3c0a2f54797065202f436174616c6f670a2f50616765732031203020520a3e3e0a656e646f626a0a787265660a302031300a303030303030303030302036353533352066200a30303030303030373533203030303030206e200a30303030303031353033203030303030206e200a30303030303030303039203030303030206e200a30303030303030303837203030303030206e200a30303030303030383430203030303030206e200a30303030303031323734203030303030206e200a30303030303031333838203030303030206e200a30303030303031363137203030303030206e200a30303030303031363933203030303030206e200a747261696c65720a3c3c0a2f53697a652031300a2f526f6f742039203020520a2f496e666f2038203020520a3e3e0a7374617274787265660a313734320a2525454f460a, '2020-10-13');

-- --------------------------------------------------------

--
-- Structure for view `bill_view`
--
DROP TABLE IF EXISTS `bill_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bill_view`  AS  select `bills`.`bill_id` AS `bill_id`,concat(`patients`.`First_Name`,' ',`patients`.`Middle_Name`,' ',`patients`.`Last_Name`) AS `pat_full_name`,`patients`.`Gender` AS `Gender`,concat(`doctors`.`first_name`,' ',`doctors`.`middle_name`,' ',`doctors`.`last_name`) AS `doc_full_name`,`doctors`.`specialization` AS `specialization`,`bills`.`issue_date` AS `issue_date`,`bills`.`pay_date` AS `pay_date`,`bills`.`amount` AS `amount` from ((`bills` join `patients`) join `doctors` on(`bills`.`pat_id` = `patients`.`Patient_ID` and `doctors`.`id` = `bills`.`doctor_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `pat_id` (`pat_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patient_ID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `pat_id` (`pat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Patient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`Patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`Patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`Patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
