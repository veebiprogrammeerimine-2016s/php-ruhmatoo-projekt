drop database if exists if16_derkun_shazza;
create database if16_derkun_shazza;
use if16_derkun_shazza;

create table usertypes (
    type varchar(6) unique not null primary key
);

insert into usertypes values ("user"), ("admin"), ("banned");

create table users (
  id int not null unique auto_increment primary key,
  username varchar(128) not null,
  email varchar(128) not null unique,
  password varchar(128),
  type varchar(6),
  date_created datetime,
  date_deleted datetime,
  foreign key (type) references usertypes(type)
);

create table categories (
  id int not null unique auto_increment primary key,
  category varchar(255) not null
);

insert into categories (category) values ("Games"), ("Hardware"), ("Software"), ("Youtube");

create table tags (
  id int not null unique auto_increment primary key,
  tagname varchar(60)
);

create table posts (
  id int not null unique auto_increment primary key,
  title varchar(255),
  content text,
  author int,
  date_added datetime,
  date_removed datetime,
  foreign key (author) references users (id)
);

create table comments (
  id int not null unique auto_increment primary key,
  author int,
  comment text,
  post int,
  date_added datetime,
  date_removed datetime,
  foreign key (author) references users (id),
  foreign key (post) references posts (id)
);