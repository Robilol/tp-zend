CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (company_id) REFERENCES companies(id)
);


CREATE TABLE `meetups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `stime` varchar(50) NOT NULL,
  `etime` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE `meetups_users` (
    `meetup_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY(meetup_id, user_id),
    FOREIGN KEY (meetup_id) REFERENCES meetups(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

/*
CREATE TABLE `meetups` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `stime` varchar(50) NOT NULL,
  `etime` varchar(50) NOT NULL,
  `user_id` INTEGER NOT NULL,
  `company_id` INTEGER NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE `companies` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL
);

CREATE TABLE `users` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `company_id` INTEGER NOT NULL,
  FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE `companies_users` (
    `company_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    FOREIGN KEY (company_id) REFERENCES companies(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
 */