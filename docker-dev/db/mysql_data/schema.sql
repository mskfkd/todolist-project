CREATE DATABASE todolist;
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
( 1, "テスト", "これはテストです。", 2021-10-31, NOW());



