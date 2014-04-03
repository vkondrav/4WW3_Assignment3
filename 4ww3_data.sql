insert into
genre(genre_name) values
("action"),
("adventure"),
("comedy"),
("crime"),
("erotica"),
("faction"),
("fantasy"),
("historical"),
("horror"),
("mystery"),
("paranoid"),
("philosophical"),
("political"),
("romance"),
("saga"),
("satire"),
("science fiction"),
("slice of life"),
("speculative"),
("thriller"),
("urban"),
("biography");

insert into
roletype(type) values
("starring actor"),
("supporting actor"),
("extra"),
("director"),
("writer");

insert into movie(title, description, year_released, rating)
values ("Wolf on Wall Street", "This is the story of New York stockbroker, Jordan Belfort. From the American dream to corporate greed, Belfort goes from penny stocks and righteousness to IPOs and a life of corruption in the late 80s. Excess success and affluence in his early twenties as founder of the brokerage firm Stratton Oakmont warranted Belfort the title 'The Wolf of Wall Street.' Money. Power. Women. Drugs. Temptations were for the taking and the threat of authority was irrelevant. For Jordan and his wolf pack, modesty was quickly deemed overrated and more was never enough.",2013,5);

set @wolf_on_wall_street = last_insert_id();

insert into movie(title, description, year_released, rating)
values("Kill Bill: Vol 1", "The Bride wakens from a four-year coma. The child she carried in her womb is gone. Now she must wreak vengeance on the team of assassins who betrayed her - a team she was once part of.", 2003, 5);

set @kill_bill_vol1 = last_insert_id();

insert into 
whatgenres(movie_id,genre_name) values
(@wolf_on_wall_street,"comedy"),
(@wolf_on_wall_street, "biography"),
(@wolf_on_wall_street, "crime");

insert into
whatgenres(movie_id,genre_name) values
(@kill_bill_vol1, "action"),
(@kill_bill_vol1, "crime");


insert into
actor(first_name,last_name,date_of_birth) values
("Leonardo", "DiCaprio", '1974-10-11');

set @leo = last_insert_id();

insert into
actor(first_name,last_name,date_of_birth) values
("Thurman", "Uma", "1970-4-29");

set @uma = last_insert_id();

insert into
award(name,reason) values
("Golden Globe Award","Best Actor");

set @golden_best_actor = last_insert_id();

insert into
award(name,reason) values
("Golden Globe Award", "Best Actress");

set @golden_best_actress = last_insert_id();

insert into
hasaward(actor_id,award_id,movie_id,year_received) values
(@leo,@golden_best_actor,@wolf_on_wall_street,2013);

insert into
hasaward(actor_id,award_id,movie_id,year_received) values
(@uma,@golden_best_actress,@kill_bill_vol1,2003);

insert into
role(actor_id,type,movie_id,character_name) values
(@leo, "starring actor", @wolf_on_wall_street, 'Jordan Belfort');

insert into
role(actor_id,type,movie_id,character_name) values
(@uma, "starring actor", @kill_bill_vol1, 'The Bride');

insert into
actor(first_name,last_name,date_of_birth) values
("Jonah", "Hill", '1983-12-20');

set @jonah = last_insert_id();

insert into
actor(first_name,last_name,date_of_birth) values
("David", "Caradine", '1936-12-8');

set @david = last_insert_id();

insert into
role(actor_id,type,movie_id,character_name) values
(@jonah, "supporting actor", @wolf_on_wall_street, 'Donnie Azoff');

insert into
role(actor_id,type,movie_id,character_name) values
(@david, "supporting actor", @kill_bill_vol1, 'Bill');

insert into
user(user_id, first_name, last_name, email_address, password) values
('kondrav', 'Vitaliy','Kondratiev', 'kondrav@live.com', "password");

insert into
user(user_id, first_name, last_name, email_address, password) values
('user', 'Steve','Stevensen', 'email@live.com', "password");

insert into
review(movie_id,user_id,comments,rating) values
(@wolf_on_wall_street, 'kondrav','It was very good', 5);

insert into
review(movie_id,user_id,comments,rating) values
(@kill_bill_vol1, 'kondrav','My Favorite', 5);