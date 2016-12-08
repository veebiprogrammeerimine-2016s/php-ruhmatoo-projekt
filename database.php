CREATE TABLE users (
	user_id INT NOT NULL AUTO_INCREMENT,
	user_name VARCHAR(16) NOT NULL,
	user_pass VARCHAR(255) NOT NULL,
	user_email  VARCHAR(255) NOT NULL,
	UNIQUE INDEX user_name_unique (user_name),
	PRIMARY KEY (user_id)
);

CREATE TABLE categories (
	cat_id INT NOT NULL AUTO_INCREMENT,
	cat_name VARCHAR(255) NOT NULL,
	UNIQUE INDEX cat_name_unique (cat_name),
	PRIMARY KEY (cat_id)
);

CREATE TABLE types (
	type_id INT NOT NULL AUTO_INCREMENT,
	type_name VARCHAR(255) NOT NULL,
	UNIQUE INDEX type_name_unique (type_name),
	PRIMARY KEY (type_id)
);

CREATE TABLE posts (
	post_id INT NOT NULL,
	post_content INT NOT NULL,
	post_cat INT NOT NULL,
	post_type INT NOT NULL,
	poster INT NOT NULL,
	FOREIGN KEY(post_cat) REFERENCES categories(cat_id),
	FOREIGN KEY(post_type) REFERENCES types(type_id),
	FOREIGN KEY(poster) REFERENCES user(user_id)
);




