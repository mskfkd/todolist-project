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

CREATE TABEL status (
	id INT(5) AUTO_INCREMENT NOT NULL,
	name VARCHAR(64) NOT NULL,
	created_at DATETIME,
	updated_at DATETIME,
	PRIMARY KEY (`id`)
);

INSERT INTO status ( name, created_at )
VALUES
( 'valid', NOW() ),
( 'invalid', NOW() ),
( 'deleted', NOW() );

CREATE TABLE todos (
	id INT(5) AUTO_INCREMENT NOT NULL,
	status_id INT(5) NOT NULL,
	user_id INT(5) NOT NULL,
	title VARCHAR(100) NOT NULL,
	detail text,
	end_at DATETIME NOT NULL,
	deleted_at DATETIME,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (`id`)
);


INSERT INTO todos ( status_id, user_id, title, detail, end_at, created_at)
VALUES
( 1, 1, "test1", "this is test.", "2023-06-30", NOW()),
( 1, 1, "test2", "this is test.", "2023-07-31", NOW()),
( 1, 1, "test3", "this is test.", "2023-08-31", NOW()),
( 1, 1, "test4", "this is test.", "2023-09-30", NOW()),
( 1, 1, "test5", "this is test.", "2023-06-30", NOW()),
( 1, 1, "test6", "this is test.", "2023-07-31", NOW()),
( 1, 1, "test7", "this is test.", "2023-08-31", NOW()),
( 1, 1, "test8", "this is test.", "2023-09-30", NOW()),
( 1, 1, "test9", "this is test.", "2023-09-30", NOW()),
( 1, 1, "test10", "this is test.", "2023-07-31", NOW()),
( 1, 1, "test11", "this is test.", "2023-08-31", NOW()),
( 1, 1, "test12", "this is test.", "2023-09-30", NOW()),
( 1, 1, "test13", "this is test.", "2023-10-31", NOW());



