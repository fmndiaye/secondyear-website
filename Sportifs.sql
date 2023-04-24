drop table sportifs cascade;
drop table compet cascade;
drop table sportifs_compets cascade;
drop table medaille cascade;
drop table sportifs_medailles cascade;
drop table epreuve cascade;
drop table sportifs_epreuves cascade;
drop table pays_code cascade;
drop table sportif cascade;

create table sportif(
	year_city text,
	sport text,
	discipline text,
	athlete text,
	country text,
	gender text,
	event text,
	medal text
);
create table sportifs(
	id serial primary key,
	nom text,
	pays text,
	vivant boolean,
	sport text,
	gender text
);
create table compet(
	id serial primary key,
	compet text
);
create table sportifs_compets(
	id_sportifs integer,
	id_compet integer
);
create table medaille(
	id serial primary key,
	medaille text
);
create table sportifs_medailles(
	id_sportifs integer,
	id_medaille integer
);
create table epreuve(
	id serial primary key,
	epreuve text
);
create table sportifs_epreuves(
	id_sportifs integer,
	id_epreuve integer
);
create table pays_code(
	country text,
	code text
);
\copy pays_code from 'pays.csv' delimiter ';' header csv;
\copy sportif from 'summer.csv' delimiter ';' header csv;
insert into pays_code(country, code) values ('Emirats arabes unis', 'EUA'),
	('Coree du Sud', 'KOR'), ('Yougoslavie', 'YUG'),
	('Nouvelle Caledonie', 'ANZ'), ('Republique Federal Allemande', 'FRG'),
	('Boheme', 'BOH'), ('Serbie', 'SRB'),('Ex-URSS', 'EUN'),('Singapour', 'SGP'),
	('Russie', 'RU1'),('Independants', 'IOP'),('PRK', 'Coree du Nord'),('Tchecoslovaquie', 'TCH'),
	('Montenegro', 'MNE'),('Trinite et Tobago', 'TTO'),('Federation des Indes Occidentales','BWI'),
	('Republique Democratique Allemande','GDR'),('Equipe mixte','ZZX'),('Rou','Roumanie'),('Ex-URSS','URS');

insert into medaille(medaille) (select distinct medal from sportif);
insert into epreuve(epreuve) (select distinct event from sportif);
insert into compet(compet) (select distinct year_city from sportif);
insert into sportifs(nom, pays, sport, gender) (select distinct athlete, (select aux.country from pays_code aux where aux.code=sportif.country), sport, gender from sportif order by athlete);

-- select distinct e.id, si.id from sportifs si, sportif s, epreuve e where si.nom=s.athlete and s.event=e.epreuve order by e.id

insert into sportifs_epreuves(id_epreuve, id_sportifs)
	(select distinct e.id, si.id from sportifs si, sportif s, epreuve e where si.nom=s.athlete and s.event=e.epreuve order by e.id);
insert into sportifs_medailles(id_medaille, id_sportifs)
	(select distinct m.id, si.id from sportifs si, sportif s, medaille m where si.nom=s.athlete and s.medal=m.medaille order by m.id);
insert into sportifs_compets(id_compet, id_sportifs)
	(select distinct c.id, si.id from sportifs si, sportif s, compet c where si.nom=s.athlete and c.compet=s.year_city);


insert into prefixe(prefixe) values 
	('Votre sportif a-t-il deja gagne une medaille'),
	('Votre sportif a-t-il participe aux Jeux Olympique de'),
	('Votre sportif a-t-il participe à l''epreuve'),
	('Votre sportif a-t-il joue sous l''enseigne du'),
	('Votre sportif pratique-t-il le');

insert into questions_prefixes(id_prefixe,colonne) values 
	('7','medaille'),
	('8','compet'),
	('9','epreuve'),
	('10','pays'),
	('11','sport');

alter table sportifs drop gender;
alter table sportifs drop vivant;