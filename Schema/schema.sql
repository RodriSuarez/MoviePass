CREATE DATABASE IF NOT EXISTS movie_pass;

USE movie_pass;

CREATE TABLE IF NOT EXISTS movie(
        id_movie INT AUTO_INCREMENT NOT NULL,
        title VARCHAR(50),
        id_api_movie INT NOT NULL,
        poster_path VARCHAR(50),
        backdrop_path VARCHAR(50),
        overview TEXT,
        vote_average FLOAT,
        #genres_id TEXT,
        release_date DATE,
        trailer_link VARCHAR(20),
        duration INT,
        director VARCHAR(30),
        rating FLOAT,
        CONSTRAINT pk_movie PRIMARY KEY (id_movie),
        CONSTRAINT unq_id_api UNIQUE (id_api_movie)
);

CREATE TABLE IF NOT EXISTS genre(
        id_genre INT AUTO_INCREMENT NOT NULL,
        name VARCHAR(50) NOT NULL,
        id_api_genre INT NOT NULL,
        CONSTRAINT pk_genre PRIMARY KEY (id_genre),
        CONSTRAINT unq_id_api UNIQUE (id_api_genre)
);


CREATE TABLE IF NOT EXISTS genre_x_movie(
        id_genre INT NOT NULL,
        id_movie INT NOT NULL,
        CONSTRAINT pk_genre_x_movie PRIMARY KEY (id_genre,id_movie),
        CONSTRAINT fk_id_genre FOREIGN KEY (id_genre) REFERENCES genre (id_genre),
        CONSTRAINT fk_id_movie FOREIGN KEY (id_movie) REFERENCES movie (id_movie)        
);

CREATE TABLE IF NOT EXISTS show_cinema(
id_show_cinema INT AUTO_INCREMENT NOT NULL,
show_time DATE,
show_hour VARCHAR(20),
id_room INT NOT NULL,
id_movie INT NOT NULL,
CONSTRAINT pk_show_cinema PRIMARY KEY (id_show_cinema),
CONSTRAINT fk_room FOREIGN KEY (id_room) REFERENCES room(id_room),
CONSTRAINT fk_movie FOREIGN KEY (id_movie) REFERENCES movie(id_movie)

);


CREATE TABLE IF NOT EXISTS cinema(
				id_cinema INT AUTO_INCREMENT NOT NULL,
                cinema_name VARCHAR (50),
				address VARCHAR(50),
                capacity INT,
                CONSTRAINT pk_cinema PRIMARY KEY(id_cinema),
                CONSTRAINT unq_cinema_name UNIQUE( cinema_name, address)
                );
                
CREATE TABLE IF NOT EXISTS  USER(
					id_user INT AUTO_INCREMENT NOT NULL,
                    first_name VARCHAR (50),
                    last_name VARCHAR (50),
                    email VARCHAR (50),
                    phone_number VARCHAR(50),
                    pass VARCHAR (50),
                    is_admin BOOLEAN ,
                    CONSTRAINT pk_user PRIMARY KEY ( id_user),
                    CONSTRAINT unq_email UNIQUE (email)	
		);
		
CREATE TABLE IF NOT EXISTS room(
			id_room INT AUTO_INCREMENT NOT NULL,
                        room_name VARCHAR(50),
                        price FLOAT,
                        id_cinema INT NOT NULL,
                        room_capacity INT,
                        CONSTRAINT pk_room PRIMARY KEY (id_room),
                        CONSTRAINT fk_cinema FOREIGN KEY (id_cinema) REFERENCES cinema(id_cinema),
                        CONSTRAINT unq_cinema_name UNIQUE (room_name, id_cinema)
                        );
