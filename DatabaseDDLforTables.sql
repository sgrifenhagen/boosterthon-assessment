CREATE TABLE `Fundraiser` (
`idFundraiser` int(11) NOT NULL AUTO_INCREMENT,
`FundraiserName` varchar(45) DEFAULT NULL,
`Phone` varchar(45) DEFAULT NULL,
`Address` varchar(45) DEFAULT NULL,
`CSZ` varchar(45) DEFAULT NULL,
`Principal` varchar(45) DEFAULT NULL,
`FAX` varchar(45) DEFAULT NULL,
`Last_Update` datetime DEFAULT NULL,
PRIMARY KEY (`idFundraiser`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8

CREATE TABLE `Reviews` (
`idReviews` int(11) NOT NULL AUTO_INCREMENT,
`idFundraiser` int(11) DEFAULT NULL,
`ReviewStars` int(11) DEFAULT NULL,
`txtReviews` varchar(500) DEFAULT NULL,
`ReviewerName` varchar(60) DEFAULT NULL,
`ReviewerEmail` varchar(45) DEFAULT NULL,
`ReviewDate` datetime DEFAULT NULL,
PRIMARY KEY (`idReviews`),
KEY `index2` (`idFundraiser`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8


