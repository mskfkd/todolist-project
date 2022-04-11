DROP DATABASE IF EXISTS todolist;
CREATE DATABASE todolist default character set utf8mb4 collate utf8mb4_bin;
USE todolist;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id INT(5) AUTO_INCREMENT NOT NULL,
	name VARCHAR(64) NOT NULL,
	email VARCHAR(64),
	created_at DATETIME,
	updated_at DATETIME,
	PRIMARY KEY (`id`)
);



INSERT INTO users ( name, email, created_at)
VALUES
( "TARO", "abc@email.jp", NOW());


CREATE TABLE todos (
	id INT(5) AUTO_INCREMENT NOT NULL,
	user_id INT(5) NOT NULL,
	title VARCHAR(100) NOT NULL,
	detail text,
	end_at DATETIME NOT NULL,
	deleted_at DATETIME,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (`id`)
);


INSERT INTO todos ( user_id, title, detail, end_at, created_at)
VALUES
( 1, "test", "this is test.", "2022-06-30", NOW()),
( 1, "2nd test", "this is 2nd test.", "2022-07-31", NOW());



