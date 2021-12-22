/* Poista aiemmat versiot ennen uusien luomista */
drop database if exists n0sahe00;

/* tietokannan luontilauseita */
create database n0sahe00;

use n0sahe00;

create table user (
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    userName varchar(50) NOT NULL,
    password varchar(150) NOT NULL,
    PRIMARY KEY (userName)
);

insert into user (firstName, lastName, userName, password) values ('John', 'Doe', 'doejohn', 'dojo');
insert into user (firstName, lastName, userName, password) values ('Jane', 'Doe', 'doejane', 'doja');
insert into user (firstName, lastName, userName, password) values ('Lisa', 'Simpson', 'simplisa', 'sili');

create table user_info (
    userName varchar(50) NOT NULL,
    userAddress text NOT NULL,
    userPhone int NOT NULL,
    FOREIGN KEY (userName) references user(userName)
);