create database shazza;
  use shazza;

create table usertypes (
    type varchar(6) not null primary key
);

insert into usertypes values ("user"), ("admin"), ("banned");

create table users (
  id int not null auto_increment primary key,
  username varchar(128) not null,
  email varchar(128),
  password varchar(128),
  type varchar(6),
  date_created timestamp,
  date_deleted timestamp,
  foreign key (type) references usertypes(values)
);

create table categories (
  id int not null auto_increment primary key,
  category varchar(255) not null,
);

create table tags (
  id int not null auto_increment primary key,
  tagname varchar(60)
);

create table posts (
  id int not null auto_increment primary key,
  title varchar(255),
  content text,
  author int,
  date_added timestamp,
  date_removed timestamp,
  foreign key (author) references users (id)
);

create table comments (
  id int not null auto_increment primary key,
  author int,
  comment text,
  post int,
  date_added timestamp,
  date_removed timestamp,
  foreign key (author) references users (id),
  foreign key (post) references posts (id)
);
