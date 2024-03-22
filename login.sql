drop database if exists login;
create database login;
use login;

create table User(
email	varchar(40),
senha	varchar(12)
);
