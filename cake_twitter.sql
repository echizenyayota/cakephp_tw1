mysql -u root -p
create database cake_twitter2;
grant all on cake_twitter2.* to USERNAME@localhost identified by 'PASSWORD';
exit;
mysql -u USERNAME -p cake_twitter2

create table posts2 (
	id int(11) not null auto_increment primary key,
	name varchar(50),
	email varchar(255) unique,
	password char(16)
);

create table users2 (
	id int(11) not null auto_increment primary key,
	name varchar(50),
	email varchar(255) unique,
	password char(16)
);

insert into users2 (name,email,password) values ('','','abc');
insert into users2 (name,email,password) values ('','','def');

insert into posts2 (name,email,password) values ('','','ghi');
insert into posts2 (name,email,password) values ('','','jkl');

// http://www.tatamilab.jp/rnd/archives/000389.html

[mysqld]
ft_min_word_len=1

create table tweet (
	id int(11) not null auto_increment primary key,
	tw_screen varchar(16),
	tw_date varchar(25),
	tw_txt text
);

desc tweet;
