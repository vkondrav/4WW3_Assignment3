create table genre(
     genre_name varchar(20) not null,
     primary key(genre_name)
);

create table movie(
     movie_id int(4) not null auto_increment,
     title varchar(20) not null,
     description text,
     year_released year,
     rating tinyint(1),
     primary key(movie_id),
     check(rating >= 0 and rating <= 5),
     constraint u_id unique (title,year_released)
);

create table whatgenres(
     movie_id int(4) not null,
     genre_name varchar(20) not null,
     primary key(movie_id,genre_name),
     foreign key(genre_name) references genre,
     foreign key(movie_id) references movie
);

create table actor(
     actor_id int(4) not null auto_increment,
     first_name varchar(20) not null,
     middle_name varchar(20),
     last_name varchar(20) not null,
     date_of_birth date,
     primary key(actor_id),
     check (date_of_birth <= curdate()),
     constraint u_id unique (first_name,last_name,date_of_birth)
);

create table user(
     user_id varchar(20) not null,
     first_name varchar(20) not null,
     middle_name varchar(20),
     last_name varchar(20) not null,
     email_address varchar(20),
     password varchar(20),
     primary key(user_id) 
);

create table review(
     movie_id int not null,
     user_id varchar(20) not null,
     comments text,
     rating tinyint(1),
     primary key(movie_id, user_id),
     foreign key(movie_id) references movie,
     foreign key(user_id) references user,
     check(rating >= 0 and rating <= 5)
);

create table award(
     award_id int not null auto_increment,
     name varchar(20) not null,
     reason varchar(20) not null,
     primary key(award_id),
     constraint u_id unique(name, reason)
);

create table hasaward(
     actor_id int,
     award_id int not null,
     movie_id int,
     year_received year not null,
     primary key(actor_id, award_id, movie_id),
     foreign key(actor_id) references actor,
     foreign key(award_id) references award
);

create table roletype(
     type varchar(20) not null,
     primary key(type)
);

create table role(
     actor_id int not null,
     type varchar(20) not null,
     movie_id int not null,
     character_name varchar(20),
     primary key(actor_id, type, movie_id),
     foreign key(actor_id) references actor,
     foreign key(type) references roletype,
     foreign key(movie_id) references movie
);

create view movie_actor as select movie.title, role.character_name, role.type, actor.first_name, actor.last_name from movie join role on movie.movie_id = role.movie_id join actor on role.actor_id = actor.actor_id;

create view actor_movie_award as select actor.first_name, actor.last_name, movie.title, award.name, award.reason from actor join hasaward on actor.actor_id = hasaward.actor_id join movie on movie.movie_id = hasaward.movie_id join award on award.award_id = hasaward.award_id;

create view movie_review as select movie.title, user.user_id, review.comments from movie join review on movie.movie_id = review.movie_id join user on user.user_id = review.user_id;