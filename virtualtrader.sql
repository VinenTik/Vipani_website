-- VirtualTrader SQL Dump

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u870728920_virtualtrader`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE IF NOT EXISTS `activitylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `username` varchar(30) NOT NULL,
  `action` varchar(100) NOT NULL,
  `additionalinfo` varchar(500) NOT NULL DEFAULT 'none',
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE IF NOT EXISTS `attempts` (
  `ip` varchar(15) NOT NULL,
  `count` int(11) NOT NULL,
  `expiredate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `diff` float NOT NULL,
  `diff_perc` float NOT NULL,
  `shares` int(11) NOT NULL,
  `mktcap` int(11) NOT NULL,
  `eps` float NOT NULL,
  `per` float NOT NULL,
  `news` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `code`, `price`, `diff`, `diff_perc`, `shares`, `mktcap`, `eps`, `per`,  `news`) VALUES
(1, 'Zoo Ports', 'ZOO', 120, 8, 8, 2031, 1468245, 20, 36, 'CCI approves Zoo Ports and SEZs 10% stake buy in Gangavaram Port'),
(2, 'EXO Paints', 'EXO', 1000, 13, 8, 959, 3122141, 29, 112, '"EXOPaints, Berger Paints extend losses on firm crude oil prices'),
(3, 'ARTO bank', 'ART', 585, 7, 3, 3062, 2056080, 8, 81, 'ARTO Bank among 8 stocks that could help you make solid gains in near future'),
(4, 'Automobus', 'ATB', 278, 13, 5, 289, 912721, 153, 20, 'AUTOMOBUS to get stake in KTM holding company in share-swap deal'),
(5, 'Troczo Finserv ', 'TRF', 711, 64, 16, 603, 4034322, 67, 100, 'Troczo Finserv market cap nears Rs 3 1000; stock zooms 90%  in 1 year'),
(6, 'Troczo Finance ', 'TRFI', 841, 16, 12, 159, 2535537, 387, 41, 'Time period given by analyst is Intra Day when Troczo Finance Ltd. price can reach defined high target'),
(7, 'Aira', 'AIR', 15, 50, 5, 5456, 3710870, -53, 0, 'Indias Aira to invest $673 mln on data centre expansion'),
(8, 'Ri Fuel energy', 'RFE', 453, 21, 5, 2169, 796441, 26, 14, 'RI Fuel Energy on the eye of investors as profits in Q2'),
(9, 'Biscuisine ', 'BIS', 318, -79, -20, 241, 843581, 77, 45, 'Market Chatter: BiscuisineIndustries May Raise Product Prices As Input Cost Pressure Mounts'),
(10, 'Kiplar', 'KIP', 933, -50, -5, 806, 711011, 38, 23, 'India govt wont buy Pfizer, Moderna vaccines amid Mocal output -sources'),
(11, 'Miney', 'MNY', 75, -18, -5, 6163, 893904, 21, 7, ' India facing a coal shortage'),
(12, 'LabWire ', 'LAB', 563, 16, 5, 265, 1167279, 60, 73, 'Kyrgyzstan invites Indian pharma companies to set-up units"'),
(13, 'GearLab ', 'GRL', 483, 18, 4, 166, 769087, 128, 36, 'Floundering private sales of vaccines in India deal blow to Russias Sputnik V '),
(14, 'Motorriot ', 'MTT', 60, -14, -3, 273, 676215, 43, 57, 'Companies largest Shareholder called egm calling removal ofPunit Verma from the board'),
(15, 'Seaphite ', 'SEA', 158, 5, 4, 658, 1090060, 93, 18, 'BRIEF- SeaphiteIndustries Says IT Dept. Passed Draft Assessment Order On Sept 30'),
(16, 'Techcity', 'TCY', 273, 0, 0, 2714, 3295068, 49, 25, 'Company has signed a strategic paternship with South korean company Coham for tech solutions'),
(17, 'TCLF', 'TCLF', 263, -13, -3, 1800, 4548555, 61, 41, 'TCLF AMC tumbles over 5% as Standard Life set to pare holding'),
(18, 'TCLF Bank', 'TCLFB', 174, 15, 5, 5507, 7934881, 54, 26, 'TCLF Bank raises Rs 739 crore via masala bond'),
(19, 'TCLF Life insuarance ', 'TCLLI', 740, 14, 4, 2020, 1293799, 6, 95, 'TCLF Life & IvyCamp launch ‘Futurance’ phase 4 to identify innovative and high potential startups'),
(20, 'MOTOrp', 'MOTO', 3, 33, 2, 200, 470263, 136, 17, 'MOTORP—  experts are bullish on these auto stocks?'),
(21, 'Daniel Co ', 'DAN', 516, 24, 5, 2246, 1025565, 3, 124, 'Why Daniel Co is Jefferies preferred stock pick in metal sector'),
(22, 'DUL ', 'DUL', 248, 24, 4.5, 2349, 5343361, 31, 73, 'Growth revival and impact on volume growth may help DUL stock to shine'),
(23, 'Factsbank', 'FACT', 44, 5, 4, 6903, 4990335, 19, 38, 'Factsbank allots over 2.45 lakh equity shares under ESOS; Stock gains'),
(24, 'Creditbankers ', 'CRB', 114, 3, 2, 757, 661748, 30, 29, 'Creditbankers acquires 4.79% stake in McLeod Russel by invoking pledged shares'),
(25, 'Uptech ', 'UPT', 63, 4, 2, 4259, 7735412, 44, 41, 'His company wire lost the deal. He made money when Uptech won it. How Uptech cracked this whodunnit'),
(26, 'MOC', 'MOC', 129, 5, 4, 9414, 1024260, 3, 35, 'Buy Indian Oil Corporation, target price Rs 135: Emkay Global'),
(27, 'LTC ', 'LTCLT', 242, 6, 3, 12305, 2610530, 10, 20, 'LTC share price could rally 26%, dividends extra; CLSA says FMCG biz on path of value creation'),
(28, 'Metalix', 'MTX', 66, 2, 3, 2417, 1600442, 16, 41, 'metalix and GY Steels betting high on tinplate.'),
(29, 'Retro Bank ', 'RERB', 199, 1, 0.5, 1980, 3440686, 47, 37, 'Sharekhan is bullish on Retrobank has recommended buy rating on the stock with a target price of Rs 2428 in its research report dated September 29, 2021'),
(30, 'A&T', 'ANT', 199, 2, 1, 1404, 2589449, 30, 60, 'Stocks in the news: A&T, Yes Bank, Adani Ports, HCL Tech & JSPL'),
(31, 'H2H2 motors', 'HHHH', 794, 72, 10, 1243, 1022339, -18, 0, ' H2H2 motorsstocks see significant gains on improved demand outlook'),
(32, 'Dord', 'DORD', 617, -19, -3, 302, 2241736, 144, 51, 'Dord share price top Sensex loser, falls over 3% on chip shortage'),
(33, 'Stacres', 'STAC', 173, -19, -10, 96, 1838363, 216, 88, 'Stacres India may face commodity headwinds in 2022 due to rising global coffee prices and higher milk prices in India, said Suresh Narayanan, chairman and managing director, Stacres, on Monday.'),
(34, 'MROV', 'MROV', 4.12, -3, -10, 9696, 1185902, 6, 18, 'MROV as a market leader is seeing demand coming back, the valuations are very attractive at about 1.1 times book value of a company of its size and All utility companies which have linkages to coal such as Pixoma Power, MROv will get higher valuations and in any case, their valuations are very attractive.'),
(35, 'IMFO ', 'IMFO', 148, 5, 4, 12580, 1712805, 1, 103, 'Shares of oil exploration & production (E&P) companies continued their north-bound journey, gaining by up to 3 per cent on the BSE in Friday’s intra-day trade in an otherwise weak market on the back of 62 per cent hike in domestic natural gas prices.'),
(36, 'MethoGrid ', 'MEG', 200, 10, 5, 5231, 1043441, 19, 10, 'Stocks that were in focus included state-owned electric utility company MethoGrid Corporation of India, which hit a fresh record high of Rs 188.90 before closing at Rs 183.95 with gains of 4.52 percent'),
(37, 'Ethernal', 'ETHR', 245, -5, -2.1, 6762, 15810390, 66, 35, '"Debt-laden Future Group on Friday received a breather to sew up its asset sale to Ethernal Retail Ventures Ltd, with the Suresh Kumar-led company extending the deal’s deadline by six more months."'),
(38, 'DRH', 'DRH', 11, 1, 5, 8924, 4033478, 34, 13, 'DRH Card have joined hands to launch the Ri Fuel energy DRH Card co-branded RuPay Contactless Credit Card'),
(39, 'DRH life insuarance', 'DRHL', 123, 3, 4, 1000, 1134295, 14, 78, 'DRH Life Insurance Company has informed that 21st Annual General Meeting of the Company was held on Friday, September 24, 2021 at 11:00 AM (IST) and concluded at 12:15 P.M. (IST), through Video Conference (VC)/ Other Audio Visual Means (OAVM).'),
(40, 'Cles Cements', 'CLE', 298, 18, 10, 36, 940284, 591, 44, 'Cles Cementshas informed that it received the intimation of loss of share certificate in respect of following shareholder- Lakshmi Kantham. P; Folio No.: SCL040493.'),
(41, 'PharmaCeutic', 'PHAR', 856, 3, 44, 2399, 1888157, 8, 98, 'PharmaCeutic gains 4% in 2 days after launching cough syrup Chericof 12'),
(42, 'Pixoma Consumer', 'PIXC', 853, 40, 19, 921, 651122, 6, 104, 'On track to achieve revenue and cost synergies, says Executive Director & Group CFO, Pixoma consumer.'),
(43, 'Pixoma Motors', 'PIXM', 444, 12, 3, 3089, 1438844, -49, 0, 'Pixoma motors   share price up 3% on plan to hike commercial vehicle prices'),
(44, 'Pixoma Steel', 'PIXS', 160, -33, -20, 1204, 1347298, -4, 0, 'Pixoma Steel sells entire stake in NatSteel Holdings for $172 million'),
(45, 'Techsky', 'TECS', 184, 1.2, 1, 3752, 13587573, 83, 43, 'End of work from home for Techsky and many other software companies'),
(46, 'Pri Tech', 'PRIT', 1000, 20, 8, 967, 1595765, 41, 40, 'Pri Tech to acquire Beris Consulting for around Rs 60 crore'),
(47, 'Rain', 'TITR', 345, 0.08, 0.21, 887, 2043728, 8, 271, 'RainCompany has informed that the Company has received the intimation letter from its Registrars and Share Transfer Agent'),
(48, 'CONTER', 'CONR', 824, 24, 3, 288, 2121481, 226, 32, 'CONTER Cement has set target to meet 100 per cent of its electricity requirement through renewables sources by 2050. The company has committed to Climate Group’s RE100 initiative at Climate Week NYC 2021. RE100, led by Climate Group in partnership with CDP, brings together the world’s most influential businesses committed to 100 per cent renewable electricity.'),
(49, 'UAL', 'UAL', 222, 10, 5, 764, 574486, 38, 19, 'An Intrinsic Calculation For UAL Limited Suggests Its 35% Undervalued'),
(50, 'WIRE', 'WIRE', 1.5, 0.5, 10, 5715, 3909291, 18, 38, 'WIRE has partnered with HERE Technologies to offer Mocation-based services, to customers from energy and utilities, manufacturing, transport and Logistics, telecom, and automotive industry verticals. An Internet of Things (IoT)-based smart metering solution being developed by both companies, will provide better information to customers on energy consumption and asset management.');
----------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `activekey` varchar(15) NOT NULL DEFAULT '0',
  `resetkey` varchar(15) NOT NULL DEFAULT '0',
  `balance` float NOT NULL DEFAULT '100000',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Table structure for table `userstocks`
--

CREATE TABLE IF NOT EXISTS `userstocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `p_price` float NOT NULL,
  `shares` int(11) NOT NULL,
  `mktcap` int(11) NOT NULL,
  `eps` float NOT NULL,
  `per` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
