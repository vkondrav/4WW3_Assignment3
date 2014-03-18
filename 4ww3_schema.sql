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
     check(rating >= 0 and rating <= 5)
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
     check (date_of_birth <= curdate())
);

create table reviewer(
     reviewer_id int not null auto_increment,
     first_name varchar(20) not null,
     middle_name varchar(20),
     last_name varchar(20) not null,
     email_address varchar(20),
     primary key(reviewer_id) 
);

create table review(
     movie_id int not null,
     reviewer_id int not null,
     comments text,
     rating tinyint(1),
     primary key(movie_id, reviewer_id),
     foreign key(movie_id) references movie,
     foreign key(reviewer_id) references reviewer,
     check(rating >= 0 and rating <= 5)
);

create table award(
     award_id int not null auto_increment,
     name varchar(20) not null,
     reason varchar(20) not null,
     primary key(award_id)
);

create table hasaward(
     actor_id int,
     award_id int not null,
     movie_id int,
     year_received year not null,
     primary key(award_id, year_received),
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

/* 'star-rating' component */
.starRate {position:relative; margin:20px; overflow:hidden; zoom:1;}
.starRate ul {width:160px; margin:0; padding:0;}
.starRate li {display:inline; list-style:none;}
.starRate a, .starRate b {background:url(img/star_rate.gif) left top repeat-x;}
.starRate a {float:right; margin:0 80px 0 -144px; width:80px; height:16px; background-position:left 16px; color:#000; text-decoration:none;}
.starRate a:hover {background-position:left -32px;}
.starRate b {position:absolute; z-index:-1; width:80px; height:16px; background-position:left -16px;}
.starRate div b {left:0px; bottom:0px; background-position:left top;}
.starRate a span {position:absolute; left:-300px;}
.starRate a:hover span {left:90px; width:100%;}

