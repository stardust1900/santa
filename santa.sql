CREATE TABLE IF NOT EXISTS user (
id int(8) unsigned NOT NULL AUTO_INCREMENT,
nickname  varchar(30) DEFAULT NULL,
email     varchar(200) DEFAULT NULL,
password  varchar(200) NOT NULL,
source    varchar(10) NOT NULL,
gender    tinyint DEFAULT 0,
bio       varchar(200) DEFAULT NULL,
reg_time  datetime NOT NULL,
PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1001;

insert into user(id,nickname,email,password,source,reg_time) values(1000,'admin','stardust1900@hotmail.com','7b744e961a04a78c43b946ce9644934e','sql',NOW());

CREATE TABLE IF NOT EXISTS address (
id int(8) unsigned NOT NULL AUTO_INCREMENT,
user_id   int(8) NOT NULL,
address   varchar(500) DEFAULT NULL,
name      varchar(30) DEFAULT NULL,
phone     varchar(30) DEFAULT NULL,
PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8  AUTO_INCREMENT=6001;


CREATE TABLE IF NOT EXISTS groups (
id int(8) unsigned NOT NULL AUTO_INCREMENT,
name      varchar(30) DEFAULT NULL,
about     varchar(100) DEFAULT NULL,
icon      varchar(100) DEFAULT NULL,
create_by int(8) NOT NULL,
create_time datetime NOT NULL,
status    tinyint DEFAULT 0,
code      varchar(100) NOT NULL,
PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8  AUTO_INCREMENT=101;

insert into groups(name,about,icon,create_by,create_time,code) values ('打劫圣诞老人团伙','有组织无纪律，有趣就是正义，好玩就是天理~','images/santa.jpg',1000,NOW(),'哇哈哈');
insert into groups(name,about,icon,create_by,create_time,code) values ('一分钟读书会','山上的朋友，让我听到你的声音','images/reading.jpg',1000,NOW(),'文艺文艺最文艺');
insert into groups(name,about,icon,create_by,create_time,code) values ('王一刀的朋友们','王一刀是最帅的','images/yidao.jpg',1000,NOW(),'王一刀好帅');
insert into groups(name,about,icon,create_by,create_time,code) values ('老少女联盟','永远少女心','images/moon.jpg',1000,NOW(),'年轻美丽');
insert into groups(name,about,icon,create_by,create_time,code) values ('通联支付','让资金更流畅,让支付更便捷','images/allinpay.jpg',1000,NOW(),'全力以赴');

CREATE TABLE IF NOT EXISTS relation (
group_id int(8) NOT NULL,
user_id  int(8) NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS wish (
id int(8) unsigned NOT NULL AUTO_INCREMENT,
content   varchar(500) DEFAULT NULL,
memo      varchar(500) DEFAULT NULL,
make_by   int(8) NOT NULL,
make_time datetime DEFAULT NULL,
take_by   int(8) DEFAULT NULL,
take_time datetime DEFAULT NULL,
status    tinyint DEFAULT 0,
group_id int(8) NOT NULL,
PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS douban (
	user_id  int(8) NOT NULL,
	db_uid varchar(30) NOT NULL,
	db_access_token varchar(200) NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS weibo (
	user_id  int(8) NOT NULL,
	wb_uid varchar(30) NOT NULL,
	wb_access_token varchar(200) NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8;