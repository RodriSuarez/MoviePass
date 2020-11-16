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
remaining_tickets INT,
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
CREATE TABLE IF NOT EXISTS  USER(
    			id_user INT AUTO_INCREMENT NOT NULL,
    			email VARCHAR (50),
      			pass VARCHAR (50),
        		first_name VARCHAR (50),
        		dni INT NOT NULL,
        		last_name VARCHAR (50),
        		description VARCHAR (50),
        		CONSTRAINT pk_user PRIMARY KEY (id_user),
        		CONSTRAINT unq_email UNIQUE (email),
        		CONSTRAINT unq_dni UNIQUE (dni)
);

CREATE TABLE IF NOT EXISTS ticket(
			id_ticket INT AUTO_INCREMENT NOT NULL,
			id_show_cinema INT NOT NULL,
			id_user INT NOT NULL,
			ticket_number INT NOT NULL,
			qr TEXT,
			CONSTRAINT pk_ticket PRIMARY KEY (id_ticket),
			CONSTRAINT fk_show FOREIGN KEY (id_show_cinema) REFERENCES show_cinema(id_show_cinema),
			CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES USER(id_user),
			CONSTRAINT unq_ticket UNIQUE (id_ticket, id_show_cinema)

);
create table if not exists buy(
			id_buy int auto_increment not null,
			id_ticket int not null,
			id_user int not null,
			fecha date,
			total float,
			#descuento int,
			Constraint pk_buy primary key (id_buy),
			constraint fk_ticket foreign key (id_ticket) references ticket(id_ticket),
			constraint fk_user foreign key (id_user) references user(id_user)
);


CREATE TABLE IF NOT EXISTS credit_cards(
		id_user int not null,
        id_card int  auto_increment not null,
        company varchar(50) NOT NULL,
		number_card int(16) NOT NULL,
		propietary varchar(50) DEFAULT NULL,
		expiration date DEFAULT NULL,
		CONSTRAINT pk_credit_card PRIMARY KEY (number_card, id_card),
        constraint fk_id_user foreign key (id_user) references user(id_user)
);
    
CREATE TABLE IF NOT EXISTS cards_payments (
	  id_cards_payments int NOT NULL AUTO_INCREMENT,
	  id_card int NOT NULL,
	  company varchar(50) NOT NULL,
	  date_payment datetime NOT NULL,
	  total double NOT NULL,
	  CONSTRAINT pk_cards_payments PRIMARY KEY (id_cards_payments),
	  CONSTRAINT fk_credit_card_x_payments FOREIGN KEY (id_card) REFERENCES credit_cards(id_card)
);
