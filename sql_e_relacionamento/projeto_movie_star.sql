CREATE DATABASE movie_star;

USE movie_star;

CREATE TABLE users(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    bio text,
    token VARCHAR(255) NOT NULL
);

CREATE TABLE movies(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    trailer VARCHAR(255),
    category VARCHAR(255) NOT NULL
);

CREATE TABLE reviews(
	id INT,
    users_id INT,
    movies_id INT,
    rating INT NOT NULL,
    review TEXT,
    PRIMARY KEY(id, users_id, movies_id),
    FOREIGN KEY (users_id) REFERENCES users (id),
    FOREIGN KEY (movies_id) REFERENCES movies (id)
);