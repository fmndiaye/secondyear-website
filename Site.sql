drop table if exists utilisateur;
drop table if exists partie;
drop table if exists commentaires;

CREATE TABLE utilisateur(
	id serial primary key,
	pseudo text,
	mdp text,
	naissance date,
	email text
);
create table partie(
	id_partie serial primary key,
	pseudo text,
	nom text,
	date_resolution timestamp
);
create table commentaires(
	id_util integer,
	pseudo text,
  	commentaire text
);

