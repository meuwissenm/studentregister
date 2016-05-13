                                                                                                                                                                                                  
  CREATE TABLE `registercourses` (
  `category` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `student` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `volunteer` enum('Yes','No') DEFAULT NULL,
  `volunteer_name` varchar(255) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `socialStudy` enum('Yes','No') DEFAULT NULL,
  `elective` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 
 CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

 CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `joined` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
  
insert into users values('admin',sha1('admin'),'yes');
