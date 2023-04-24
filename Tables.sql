drop table if exists pays cascade;
drop table if exists symbole cascade;
drop table if exists couleur cascade;
drop table if exists pays_couleurs cascade;
drop table if exists pays_formes cascade;
drop table if exists pays_symboles cascade;
drop table if exists forme cascade;
drop table if exists prefixe cascade;
drop table if exists match cascade;
drop table if exists questions_prefixes cascade;

Create table pays(
	id serial primary key,
	nom text,
	continent text, --continent
	acces_a_la_mer boolean, --mer
	regime_politique text, --regime
	langue_officielle text, -- langue
	personne_politique text
);
Create table forme( id serial primary key, forme text );
Create table symbole( id serial primary key, symbole text);
Create table couleur( id serial primary key, couleur text );
Create table pays_couleurs( id_pays integer, id_couleur integer);
Create table pays_formes( id_pays integer, id_forme integer);
Create table pays_symboles( id_pays integer, id_symbole integer);

insert into symbole(symbole) values 
('Etoile'),('Soleil'),('Animal'),('Croissant'),('Cercle'),('Demi Cercle'),('Triangle'),
('Croix'),('X'),('Ecriture'),('Vegetal'),('Carre en coin'),('Dessin'),('Losange'),('Aucun');
insert into pays_symboles values ('1','5'),('1','13'),('2','9'),('3','15'),('4','13'),('5','7'),('5','13'),('5','9'),('6','10'),('7','11'),('8','5'),('8','3'),('9','15'),('10','15'),('11','8'),('12','4'),('12','1'),('12','5'),('13','5'),('13','7'),('14','7'),('14','6'),('15','11'),
	('15','13'),('16','13'),('16','8'),('17','13'),('18','2'),('19','15'),('20','15'),('21','15'),('22','9'),('23','1'),('24','1'),('25','13'),('26','6'),('26','13'),('27','4'),('27','1'),('28','15'),('29','5'),('30','2'),('30','13'),('31','13'),('32','1'),('32','5'),('33','2'),('34','1'),
	('35','9'),('35','6'),('36','8'),('37','2'),('37','7'),('38','15'),('39','13'),('40','13'),('41','1'),('41','12'),('42','8'),('42','9'),('42','1'),('43','13'),('44','15'),('45','1'),('45','12'),('46','8'),('47','15'),('48','15'),('49','5'),('49','10'),('50','4'),('50','2'),('50','12'),
	('51','1'),('51','6'),('52','8'),('53','10'),('54','1'),('55','15'),('56','15'),('57','13'),('58','2'),('59','15'),('60','15'),('61','15'),('62','5'),('63','15'),('64','8'),('64','12'),('65','8'),('66','8'),('67','15'),('68','7'),('69','2'),('69','1'),('69','7'),('70','15'),('71','15'),
	('72','13'),('73','1'),('74','13'),('74','10'),('75','4'),('75','1'),('75','7'),('76','1'),('77','15'),('78','5'),('78','1'),('79','8'),('80','15'),('81','13'),('82','1'),('82','8'),('82','5'),('83','2'),('83','7'),('84','1'),('85','13'),('86','15'),('87','14'),('88','13'),('89','7'),
	('89','1'),('90','5'),('90','13'),('91','13'),('92','13'),('93','1'),('94','4'),('94','1'),('95','15'),('96','5'),('96','13'),('97','1'),('97','13'),('98','4'),('98','2'),('98','1'),('99','4'),('99','1'),('100','15'),('101','5'),('102','1'),('102','7'),('103','12'),('103','1'),('103','2'),
	('103','9'),('103','8'),('104','15'),('105','13'),('106','15'),('107','13'),('108','15'),('109','12'),('109','8'),('110','7'),('111','4'),('111','1'),('112','5'),('113','13'),('113','8'),('113','9'),('113','12'),('114','1'),('114','3'),('114','5'),('114','8'),('115','7'),('115','13'),('116','15'),
	('117','13'),('118','1'),('118','13'),('119','12'),('119','1'),('120','15'),('121','15'),('122','14'),

('123','7'),('123','1'),
('124','1'),
('125','1'),
('126','1'),
('127','2'),
('127','5'),('127','13'), --correspond a 127
('128','4'),('128','1'),('129','13'),('130','13'),('130','2'),('131','15'),('132','15'),
	('133','15'),('134','13'),('134','4'),('134','1'),('134','5'),('135','1'),('135','12'),
	('136','7'),('137','15'),('138','1'),('139','1'),('140','7'),('140','1'),('141','5'),
	('142','1'),('143','13'),('143','2'),('144','11'),('145','15'),('146','2'),('146','5'),
	('146','13'),('147','1'),
	('148','7'),('148','13'),('148','5'),('149','7'),('149','1'),('150','13'),('150','8'),
	('150','5'),('151','13'),('151','8'),('152','5'),('152','1'),('153','12'),('153','1'),
	('154','15'),('155','4'),('155','1'),('156','7'),('157','2'),('157','5'),('157','13'),
	('158','4'),('158','1'),('159','7'),
	('159','1'),
('160','15'), --correspond a 160
('161','1'),('161','13'), --correspond a 161
('162','13'),('163','13'),('163','3'),('164','13'),('164','4'),('165','15'),('166','2'),
('166','13'),('167','13'),('168','3'),('168','13'),('169','6'),('169','13'),('170','15'),
('171','7'),('171','11'),('172','1'),('172','3'),('172','7'),
	('173','2'),('174','13'),('175','15'),('176','13'),('177','12'),('176','1'),('178','2'),
	('178','13'),('179','14'),('179','5'),('180','1'),('180','13'),('180','5'),('181','2'),
	('182','15'),('183','9'),('183','13'),('184','8'),('185','15'),

('186','1'),('187','1'),
('188','8'),('188','9'), --correspond a 188
	('189','12'),('189','8'),('189','9'),('189','1'), --correspond a 189
	('190','10'),('190','1'), --correspond a 190
('191','7'),('192','5'),('192','13'),('193','2'),('193','13'),('194','12'),('194','1'),('194','8'),('195','7'),('195','1');


insert into forme(forme) values
('bandes horizontales'),('bandes verticales'),('Croix'),('Croix Scandinave'),('Plat'),('en X'),('Diagonal descendante'),('Diagonal ascendante');
insert into pays_formes values 
('1','1'),('2','1'),('3','8'),('4','1'),('5','1'),('6','1'),('7','1'),('8','1'),('9','2'),('10','2'),('11','2'),('12','5'),('13','1'),('14','1'),('15','5'),('16','3'),('17','5'),('18','8'),('19','1'),('20','1'),('21','1'),('22','6'),('23','1'),('24','1'),('25','1'),('26','5'),('27','1'),('28','1'),
('29','5'),('30','5'),('31','1'),('32','1'),('33','1'),('34','1'),('35','2'),('36','4'),('37','1'),('38','1'),('39','1'),('40','1'),('41','5'),('42','5'),('43','1'),('44','2'),('45','1'),('46','4'),('47','1'),('48','2'),('49','5'),('50','1'),('51','1'),('52','4'),('53','5'),('54','1'),('55','1'),
('56','1'),('57','1'),('58','1'),('59','1'),('60','1'),('61','1'),('61','2'),('62','1'),('63','2'),('64','1'),('65','4'),('66','4'),('67','2'),('68','1'),('69','1'),('70','2'),('71','1'),('72','1'),('73','5'),('74','8'),('75','1'),('76','1'),('76','2'),('77','2'),('78','1'),('79','5'),('80','1'),
('80','2'),('81','2'),('82','6'),('83','5'),('84','2'),('85','7'),('86','1'),('87','1'),('87','2'),('88','2'),('89','5'),('90','1'),('91','5'),('92','5'),('93','1'),('94','5'),('95','1'),('96','2'),('97','1'),('98','1'),('99','2'),('100','1'),('101','5'),('102','1'),('103','5'),('104','1'),('105','1')
,('106','1'),('107','1'),('108','1'),('109','5'),('110','5'),('111','1'),('112','5'),('113','5'),('114','3'),('115','1'),('116','1'),('117','5'),('118','5'),('119','1'),('120','2'),('121','1'),('122','2'),('123','8'),('124','5'),('125','8'),('126','1'),('127','2'),('128','5'),('129','1'),('130','3'),
('131','1'),('132','1'),('133','1'),('134','2'),('135','1'),('136','1'),('137','1'),('138','1'),('139','5'),('140','1'),('141','1'),('142','5'),('143','7'),('144','2'),('145','2'),('146','5'),('147','1'),('147','2'),('148','5'),('149','1'),('150','1'),('151','1'),('152','1'),('153','1'),('154','1'),
('155','1'),('156','1'),('157','5'),('158','1'),('159','5'),('160','1'),('161','7'),('162','1'),('163','2'),('164','5'),('165','7'),('166','1'),('167','1'),('168','2'),('169','2'),('170','8'),('171','1'),('172','1'),('173','1'),('174','1'),('175','2'),('176','1'),('177','5'),('178','5'),('179','5'),
('180','2'),('181','1'),('182','1'),('182','2'),('183','1'),('184','3'),('185','1'),('186','2'),('187','5'),('188','3'),('188','6'),('189','5'),('190','1'),('191','5'),('192','1'),('193','1'),('194','5'),('195','1');
insert into couleur(couleur) values('rouge'),('bleu'),('vert'),('blanc'),('jaune'),('noir');

insert into pays_couleurs values ('1','1'),('1','2'),('1','3'),('1','5'),('2','1'),('2','3'),('2','4'),('3','2'),('3','3'),('3','6'),('3','5'),('4','1'),('4','2'),('4','4'),('5','1'),('5','3'),('5','4'),('5','5'),('5','6'),('6','1'),('6','3'),('6','4'),('6','6'),('7','1'),('7','3'),('7','4'),
('8','1'),('8','4'),('8','5'),('8','6'),('9','3'),('9','4'),('10','1'),('10','3'),('10','4'),('11','4'),('11','1'),('12','1'),('12','4'),('13','2'),('13','4'),('13','3'),('13','5'),('14','2'),('14','4'),('14','3'),('14','5'),('15','1'),('15','3'),('15','5'),('15','6'),('16','1'),('16','3'),
('16','4'),('17','4'),('18','1'),('18','2'),('18','3'),('18','4'),('18','5'),('19','1'),('19','2'),('19','3'),('19','5'),('20','1'),('20','4'),('20','2'),('21','1'),('21','5'),('21','3'),('22','6'),('22','5'),('22','3'),('23','2'),('23','4'),('24','1'),('24','3'),('24','4'),('24','5'),('25','1'),
('25','3'),('25','4'),('25','6'),('26','3'),('26','4'),('26','5'),('27','3'),('27','4'),('28','1'),('28','4'),('29','1'),('29','4'),('30','2'),('30','5'),('31','1'),('31','2'),('31','4'),('31','5'),('32','1'),('32','2'),('32','4'),('33','2'),('33','4'),('33','5'),('34','1'),('34','3'),('34','4'),
('34','6'),('35','2'),('35','3'),('35','4'),('36','1'),('36','2'),('36','4'),('37','1'),('37','3'),('37','4'),('37','6'),('38','1'),('38','4'),('39','1'),('39','5'),('40','1'),('40','2'),('40','4'),('41','1'),('41','2'),('41','4'),('42','1'),('42','2'),('42','4'),('43','1'),('43','2'),('43','5'),
('43','6'),('44','1'),('44','2'),('44','5'),('45','1'),('45','2'),('45','4'),('46','2'),('46','4'),('47','1'),('47','3'),('47','4'),('48','1'),('48','5'),('48','6'),('49','1'),('49','2'),('49','4'),('49','6'),('50','1'),('50','2'),('50','5'),('50','4'),('51','1'),('51','2'),('51','5'),('51','4'),
('52','1'),('52','2'),('52','4'),('53','3'),('53','4'),('54','2'),('54','4'),('55','1'),('55','2'),('55','4'),('56','1'),('56','2'),('56','5'),('57','1'),('57','4'),('57','3'),('58','2'),('58','5'),('58','4'),('59','2'),('59','5'),('60','1'),('60','5'),('60','6'),('61','1'),('61','3'),('61','4'),
('61','6'),('62','1'),('62','2'),('62','4'),('63','3'),('63','4'),('63','5'),('64','2'),('64','4'),('65','1'),('65','4'),('66','2'),('66','5'),('67','1'),('67','4'),('68','1'),('68','2'),('68','3'),('68','4'),('68','5'),('68','6'),('69','1'),('69','2'),('69','5'),('69','4'),('70','1'),('70','2'),
('70','4'),('71','1'),('71','4'),('72','1'),('72','4'),('72','5'),('72','6'),('73','1'),('73','5'),('74','5'),('74','4'),('75','1'),('75','2'),('75','3'),('75','4'),('75','5'),('76','1'),('76','2'),('76','3'),('76','4'),('76','5'),('77','1'),('77','2'),('77','5'),('78','1'),('78','2'),('78','4'),
('78','5'),('79','1'),('79','4'),('80','1'),('80','3'),('80','5'),('81','1'),('81','2'),('81','5'),('82','1'),('82','3'),('82','4'),('83','1'),('83','2'),('83','4'),('83','6'),('84','1'),('84','5'),('84','3'),('85','1'),('85','5'),('85','4'),('85','6'),('86','1'),('86','4'),('87','1'),('87','3'),
('87','4'),('88','2'),('88','5'),('88','6'),('89','2'),('89','5'),('89','4'),('90','1'),('90','2'),('90','3'),('90','4'),('90','5'),('91','1'),('91','4'),('92','1'),('92','6'),('93','1'),('93','3'),('93','5'),('94','1'),('94','4'),('95','1'),('95','2'),('95','5'),('96','1'),('96','6'),('96','3'),
('96','5'),('97','1'),('97','6'),('97','5'),('98','1'),('98','2'),('98','3'),('98','4'),('99','1'),('99','3'),('99','4'),('100','2'),('100','4'),('100','6'),('101','1'),('101','3'),('102','1'),('102','2'),('102','4'),('103','1'),('103','2'),('103','4'),('104','1'),('104','4'),('104','2'),('105','1'),
('105','2'),('105','4'),('106','1'),('106','3'),('106','5'),('107','1'),('107','2'),('107','4'),('108','4'),('108','1'),('108','3'),('109','1'),('109','4'),('110','2'),('110','4'),('110','5'),('111','1'),('111','4'),('112','2'),('112','5'),('113','1'),('113','2'),('113','4'),('114','1'),('114','3'),
('114','4'),('114','5'),('114','6'),('115','1'),('115','3'),('115','5'),('115','6'),('116','2'),('116','3'),('116','4'),('117','1'),('117','2'),('117','3'),('117','4'),('117','5'),('118','2'),('118','4'),('118','5'),('119','1'),('119','2'),('119','4'),('120','1'),('120','3'),('120','5'),
('121','1'),
('121','2'),('121','3'),('121','4'),

('122','2'),('122','3'),('122','5'), 


('123','2'),('123','3'),('123','5'),('123','4'),
('124','1'),('124','5'), 
('125','1'),('125','3'),('125','4'),('125','5'),('125','6'),
('126','2'),('126','4'),
('126','5'),('127','1'),('127','3'),('127','5'),('127','4'),('128','3'),('128','5'),('129','1'),('129','4'),('129','3'),('129','6'),('130','1'),('130','3'),('130','5'),('131','1'),('131','2'),
('131','4'),('132','2'),('132','3'),('132','5'),('133','1'),('133','4'),('134','3'),('134','1'),('134','4'),
('134','5'),('135','1'),('135','3'),('135','4'),('135','5'),('136','2'),('136','5'),('136','6'),('137','1'),('137','2'),('137','4'),('138','1'),('138','4'),('138','3'),('138','5'),('139','2'),
('139','4'),('140','1'),('140','3'),('140','5'),('140','6'),('141','5'),('141','3'),('141','4'),('142','2'),
('142','4'),('143','2'),('143','4'),('143','5'),('144','1'),('144','4'),('145','3'),('145','1'),('145','5'),('146','1'),('146','5'),('147','1'),('147','3'),('147','5'),('147','6'),
('148','1'),('148','5'),('148','2'),('148','3'),('149','1'),('149','2'),('149','4'),('149','3'),('150','2'),('150','3'),
('150','4'),('150','5'),('151','1'),('151','2'),('151','5'),('152','5'),('152','4'),('152','3'),('152','2'),('153','1'),('153','2'),('153','4'),('154','1'),('154','4'),('154','6'),('155','1'),
('155','2'),('155','3'),('155','4'),('156','1'),('156','3'),('156','4'),('156','6'),('157','1'),('157','5'),
('158','1'),('158','6'),('158','3'),('158','4'),

('159','1'),('159','5'),('159','4'),('159','6'),
('160','1'),('160','2'),('160','4'), 
('161','1'),('161','5'),('161','6'),('161','4'), 
('162','1'),('162','5'),('162','2'),('162','3'),('163','1'),('163','2'),('163','5'),('164','1'),('164','3'),('164','4'),
('165','1'),('165','4'),('165','6'),('166','1'),('166','3'),('166','4'),('166','5'),('167','1'),('167','2'),('167','4'),('167','6'),('167','5'),('168','5'),('168','1'),('168','3'),
('169','1'),('169','3'),('169','4'),('169','5'),('170','3'),('170','5'),('170','1'),('171','1'),('171','2'),('171','4'),
('171','3'),('172','1'),('172','3'),('172','4'),('172','6'),('172','5'),('173','2'),('173','5'),('173','3'),('174','2'),('174','4'),('174','6'),('174','3'),('175','5'),('175','3'),('175','4'),
('176','1'),('176','2'),('176','5'),('176','3'),('176','4'),('177','1'),('177','2'),('177','4'),('178','4'),
('178','1'),('178','2'),
('179','3'),('179','2'),('179','5'),
('180','1'),('180','2'),('180','5'), 
('181','1'),('181','3'),('181','6'), 
('182','4'),('182','1'),('182','3'),('183','1'),('183','3'),('183','6'),('183','5'),('184','1'),('184','4'),('185','2'),('185','6'),('185','4'),('186','3'),('186','1'),
('186','5'),
('187','1'),('187','5'),
('188','1'),('188','2'),('188','4'), 
('189','1'),('189','2'),('189','4'),('189','5'),('189','6'),
('190','1'),('190','4'),('190','3'),('190','6'),('191','1'),('191','3'),('191','4'),('191','5'),('191','6'),('192','1'),('192','2'),('192','4'),('193','1'),('193','2'),('193','4'),('193','5'),('194','1'),('194','2'),('194','4'),('194','5'),
('195','1'),('195','2'),('195','3'),('195','4'),('195','5');
insert into pays(nom, continent, acces_a_la_mer, regime_politique, langue_officielle, personne_politique) values
('Ethiopie','Afrique','false','Republique Federale','Amharique','Mulatu Teshome'),
('Oman','Asie','true','Monarchie Absolue','Arabe','Qabus ibn Said'),
('Tanzanie','Afrique','true','Republique','Kiswahili','John Magufuli'),
('Slovenie','Europe','true','Republique Parlementaire','Slovene','Borut Pahor'),
('Mozambique','Afrique','true','Republique','Portugais','Filipe Nyusi'),
('Iraq','Asie','true','Republique Federale','Arabe','Fouad Massoum'),
('Liban','Asie','true','Republique Parlementaire','Arabe','Michel Aoun'),
('Ouganda','Afrique','false','Republique Parlementaire','Arabe','Yoweri Museveni'),
('Nigeria','Afrique','true','Republique Federale','Anglais','Muhammadu Buhari'),
('Italie','Europe','true','Republique Parlementaire','Italien','Sergio Mattarella'),
('Malte','Europe','true','Republique','Maltais','Marie-Louise Coleiro Preca'),
('Tunisie','Afrique','true','Republique Semi-presidentielle','Arabe','Behi Caid el Sebsi'),
('Nicaragua','Amerique du Nord','true','Republique','Espagnol','Daniel Ortega'),
('Salvador','Amerique du Nord','true','Republique','Espagnol','Salvador Sanchez Ceren'),
('Zambie','Afrique','false','Republique','Anglais','Edgar Lungu'),
('Republique Dominicaine','Amerique du Nord','true','Republique','Espagnol','Danilo Medina'),
('Qatar','Asie','true','Monarchie Absolue','Arabe','Tamim ben Hamad Al Thani'),
('Namibie','Afrique','true','Republique','Anglais','Hage Geingob'),
('Maurice','Afrique','true','Republique Parlementaire','Anglais','Ameenah Gurib-Fakim'),
('Luxembourg','Europe','false','Monarchie Constitutionnelle','Luxembourgeois','Xavier Bettel'),
('Lituanie','Europe','true','Republique Parlementaire','Lituanien','Dalia Grybauskaite'),
('Jamaïque','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Elisabeth II'),
('Honduras','Amerique du Nord','true','Republique','Espagnol','Juan Orlando Hernandez'),
('Birmanie','Asie','true','Republique Parlementaire','Birman','Win Myint'),
('Kenya','Afrique','true','Republique','Swahili','Uhuru Kenyatta'),
('Chypre','Europe','true','Republique','Grec','Nikos Anastasiadis'),
('Pakistan','Asie','true','Republique Islamique','Ourdou','Mamnoon Hussain'),
('Lettonie','Europe','true','Republique Parlementaire','Letton','Raimonds Vejonis'),
('Japon','Asie','true','Monarchie Constitutionnelle','Japonais','Akihito'),
('Kazakhstan','Asie','false','Republique','Kazakh','Noursoultan Nazarbaiev'),
('Serbie','Europe','false','Republique Parlementaire','Serbe','Aleksandar Vucic'),
('Coree du Nord','Asie','true','Republique','Coreen','Kim Jong-un'),
('Uruguay','Amerique du Sud','true','Republique Presidentielle','Espagnol','Tabare Vazquez'),
('Syrie','Asie','true','Republique','Arabe','Bachar el-Assad'),
('Guatemala','Amerique du Nord','true','Republique','Espagnol','Jimmy Morales'),
('Islande','Europe','true','Republique Parlementaire','Islandais','Guoni Th. Johannesson'),
('Jordanie','Asie','true','Monarchie Constitutionnelle','Arabe','Abdallah II'),
('Monaco','Europe','true','Monarchie','Francais','Dmitri Rybolovlev'),
('Espagne','Europe','true','Monarchie Constitutionnelle','Espagnol','Mariano Rajoy'),
('Slovaquie','Europe','false','Republique Parlementaire','Slovaque','Andrej Kiska'),
('Panama','Amerique du Nord','true','Republique','Espagnol','Juan Carlos Varela'),
('Nouvelle-Zelande','Oceanie','true','Monarchie Parlementaire','Anglais','Patsy Reddy'),
('Equateur','Amerique du Sud','true','Republique','Espagnol','Lenin Moreno'),
('Roumanie','Europe','true','Republique Semi-presidentielle','Roumain','Klaus lohannis'),
('Republique du Chili','Amerique du Sud','true','Republique Presidentielle','Espagnol','Sebastian Pinera'),
('Finlande','Europe','true','Republique Parlementaire','Finnois','Sauli Niinisto'),
('Hongrie','Europe','false','Republique Parlementaire','Hongrois','Janos Ader'),
('Belgique','Europe','true','Monarchie Constitutionnelle','Francais','Charles Michel'),
('Coree du Sud','Asie','true','Republique','Coreen','Moon Jae-in'),
('Malaisie','Oceanie','true','Monarchie Constitutionnelle','Malaisien','Muhammad Faris Petra'),
('Venezuela','Amerique du Sud','true','Republique Federale Presidentielle','Espagnol','Nicolas Maduro'),
('Norvege','Europe','true','Monarchie Constitutionnelle','Norvegien','Harald V'),
('Arabie-saoudite','Asie','true','Monarchie Dynastique','Arabe','Abdallah ben Adbdelaziz Al Saoud'),
('Israël','Asie','true','Republique Parlementaire','Hebreu','Reuven Rivlin'),
('Republique-Tcheque','Europe','false','Republique Parlementaire','Tcheque','Milos Zeman'),
('Colombie','Amerique du Sud','true','Republique Presidentielle','Espagnol','Juan Manuel Santos'),
('Iran','Asie','true','Republique Islamique','Persan','Hassan Rohani'),
('Argentine','Amerique du Sud','true','Republique Federale','Espagnol','Mauricio Macri'),
('Ukraine','Europe','true','Republique Parlementaire', 'Ukrainien','Petro Porochenko'),
('Allemagne','Europe','false','Republique Constitutionnelle','Allemand','Angela Merkel'),
('Emirats arabes unis','Asie','true','Etat Federal','Arabe','Khalifa ben Zayed Al Nahyane'),
('Laos','Asie','false','Republique','Laotien','Boungnang Vorachit'),
('Irlande','Europe','true','Republique Parlementaire','Irlandais','Michael D. Higgins'),
('Grece','Europe','true','Republique Parlementaire','Grec','Prokópis Pavlópoulos'),
('Danemark','Europe','true','Monarchie Constitutionnelle','Danois','Helle Thorning-Schmidt'),
('Suede','Europe','true','Monarchie Constitutionnelle','Sudeois','Carl XVI Gustaf'),
('Perou','Amerique du Sud','true','Republique Presidentielle','Espagnol','Pedro Pablo Kuczynski'),
('Afrique-du-Sud','Afrique','true','Republique Constitutionnelle','Anglais','Cyril Ramaphosa'),
('Philippines','Oceanie','true','Republique','Filipino','Rodrigo Duterte'),
('France','Europe','true','Republique Constitutionnelle Semi-presidentielle','Francais','Emmanuel Macron'),
('Indonesie','Oceanie','true','Republique','Indonesien','Joko Widodo'),
('Egypte','Afrique','true','Republique','Arabe','Abdel Fattah al-Sissi'),
('Maroc','Afrique','true','Monarchie Constitutionnelle','Arabe','Mohammed VI'),
('Bhoutan','Asie','false','Monarchie Constitutionnelle','Dzongkha','Jigme Khesar Namgyel'),
('Comores','Afrique','true','Republique Federale','Shikomor','Azali Assoumani'),
('Republique-centrafricaine','Afrique','false','Republique','Francais','Faustin-Archange Touadéra'),
('Tchad','Afrique','false','Republique','Arabe','Idriss Déby'),
('Cap-Vert','Afrique','true','Republique','Portugais','Jorge Carlos Fonseca'),
('Suisse','Europe','false','Etat Federal','Allemand','Alain Berset'),
('Benin','Afrique','true','Republique','Francais','Patrice Talon'),
('Andorre','Europe','false','Principaute','Catalan','Antoni Marti'),
('Burundi','Afrique','true','Republique','Francais','Pierre Nkurunziza'),
('Antigua-et-Barbuda','Amerique du Sud','true','Monarchie Constitutionnelle','Anglais','Rodney Williams'),
('Cameroun','Afrique','true','Republique','Francais','Paul Biya'),
('Brunei','Oceanie','true','Monarchie Absolue','Malais','Hassanal Bolkiah'),
('Pologne','Europe','true','Republique Semi-presidentielle','Polonais','Andrzej Duda'),
('Bielorussie','Europe','false','Republique Presidentielle','Russe','Alexandre Loukachenko'),
('Barbade','Amerique du Sud','true','Monarchie Constitutionnelle','Anglais','Sandra Mason'),
('Bosnie-Herzegovine','Europe','true','Republique Federale','Bosnien','Mladen Ivanic'),
('Belize','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Colville Young'),
('Bahrein','Asie','true','Monarchie Constitutionnelle','Arabe','Hamed ben Issa al-Khalifa'),
('Albanie','Europe','true','Republique Parlementaire','Albanais','Ilir Meta'),
('Burkina-faso','Afrique','false','Republique','Francais','Roch Marc Christian Kaboré'),
('Turquie','Asie','false','Regime Presidentiel','Turc','Recep Tayyip Erdogan'),
('Armenie','Asie','false', 'Republique Parlementaire','Armenien','Serge Sargsian'),
('Afghanistan','Asie','false','Republique Islamique','Dari','Ashraf Ghani'),
('Angola','Afrique','true','Republique Presidentielle','Portugais','João Lourenço'),
('Azerbaijan','Asie','true','Republique Presidentielle','Azeri','Ilham Aliyev'),
('Algerie','Afrique','true','Republique','Arabe','Abdelaziz Bouteflika'),
('Botswana','Afrique','false','Republique','Tswana','Seretse Ian Khama'),
('Bangladesh','Asie','true','Republique','Bengali','Abdul Hamid'),
('Cuba','Amerique-centrale','true','Etat Communiste','Espagnol','Raúl Castro'),
('Australie','Oceanie','true','Monarchie Constitutionnelle Parlementaire Federale', 'Anglais','Peter Cosgrove'),
('Costa-Rica','Amerique du Nord','true','Republique Constitutionnelle','Espagnol','Luis Guillermo Solís'),
('Cambodge','Asie','true','Monarchie Constitutionnelle','Khmer','Norodom Sihamoni'),
('Bolivie','Amerique du Sud','false','Republique Presidentielle','Espagnol','Evo Morales'),
('Croatie','Europe','true','Republique Parlementaire','Croate','Kolinda Grabar-Kitarović'),
('Bulgarie','Europe','true','Republique Parlementaire','Bulgare','Roumen Radev'),
('Ile Tonga','Oceanie','true','Monarchie Constitutionnelle','Tongien','Tupou VI'),
('Sainte-Lucie','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Neville Cenac'),
('Singapour','Asie','true','Republique','Anglais','Halimah Yacob'),
('Palaos','Oceanie','true','Republique','Anglais','Tommy Remengesau'),
('Iles fidji','Oceanie','true','Republique Parlementaire','Anglais','Jioji Konrote'),
('Dominique','Amerique du Nord','true','Republique','Anglais','Charles Savarin'),
('Vanuatu','Oceanie','true','Republique','Bichelamar','Tallis Obed Moses'),
('Republique de Sierra Leone','Afrique','true','Republique','Anglais','Ernest Bai Koroma'),
('Seychelles','Afrique','true','Republique','Anglais','Danny Faure'),
('Kosovo','Europe','false','Republique Parlementaire','Albanais','Hashim Thaçi'),
('Etats-Unis','Amerique du Nord','true','Republique Constitutionnelle','Anglais','Donald Trump'),
('Guinee','Afrique','true','Republique','Francais','Alpha Condé'),
('Gambie','Afrique','true','Republique Presidentielle','Anglais','Adama Barrow'),
('Saint-Vincent-et-les-grenadines','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Frederick Ballantyne'),
('Iles Salomon','Oceanie','true','Monarchie Constitutionnelle','Anglais','Frank Kabui'), --------------
('Viêt Nam','Asie','true','Etat Communiste','Vietnamien','Tran Dai Quang'),
('Saint-Christophe-et-Nieves','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Tapley Seaton'),
('Nauru','Oceanie','true','Republique','Nauruan','Baron Waqa'),
('Portugal','Europe','true','Republique Semi-presidentielle','Portugais','Marcelo Rebelo de Sousa'),
('Mauritanie','Afrique','true','Republique Islamique','Arabe','Mohamed Ould Abdel Aziz'),
('Koweït','Asie','true','Monarchie Constitutionnelle','Arabe','al-Moubarak al-Ahmad al-Sabah'),
('Grenade','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Cecile La Grenade'),
('Thaïlande','Asie','true','Monarchie Constitutionnelle','Thaï','Rama X'),
('Gabon','Afrique','true','Republique','Francais','Ali Bongo Ondimba'),
('Autriche','Europe','false','Republique Semi-presidentielle','Allemand','Alexander Van der Bellen'),
('Turkmenistan','Asie','true','Parti unique nationaliste','Turkmen','Gurbanguly Berdimuhamedow'),
('Togo','Afrique','true','Republique','Francais','Faure Gnassingbé'),
('Bahamas','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Marguerite Pindling'),
('Pays Bas','Europe','true','Monarchie Constitutionnelle','Neerlandais','Mark Rutte'),
('Suriname','Amerique du Sud','true','Republique','Neerlandais','Desi Bouterse'),
('Somalie','Afrique','true','Republique Federale','Somalien','Mohamed Abdullahi Mohamed'),
('Sao Tome-et-Principe','Afrique','false','Republique','Portugais','Manuel Pinto da Costa'),
('Niger','Afrique','false','Republique Semi-presidentielle','Francais','Mahamadou Issoufou'),
('Micronesie','Oceanie','true','Republique Federale','Anglais','Peter Christian'),
('îles Marshall','Oceanie','true','Republique Parlementaire','Marshallais','Hilda Heine'),
('Canada','Amerique du Nord','true','Monarchie Constitutionnelle','Anglais','Justin Trudeau'),
('Mali','Afrique','false','Republique','Francais','Ibrahim Boubacar Keïta'),
('Kirghizistan','Asie','false','Republique Parlementaire','Kirghize','Sooronbay Jeenbekov'),
('Guinee-Bissau','Afrique','true','Republique','Portugais','José Mário Vaz'),
('Erythree','Afrique','true','Republique Unitaire','Tigrigna','Isaias Afwerki'),
('Djibouti','Afrique','true','Republique','Francais','Ismaïl Omar Guelleh'),
('Saint-Marin','Europe','false','Republique Parlementaire','Italien','Enrico Carattoni'),
('Liechtenstein','Europe','false','Principaute Constitutionnelle Parlementaire Unitaire','Allemand','Hans-Adam II'),
('Inde','Asie','true','Republique Parlementaire Federale','Hindi','Ram Nath Kovind'),
('Liberia','Afrique','true','Republique','Anglais','George Weah'),
('Yemen','Asie','true','Republique','Arabe','Abdrabbo Mansour Hadi'),
('Ouzbekistan','Asie','false','Republique Semi-presidentielle','Ouzbek','Shavkat Mirziyoyev'),
('Soudan','Afrique','true','Republique Federale','Arabe','Omar el-Béchir'),
('Macedoine','Europe','false','Republique Parlementaire','Macedonien','Gjorge Ivanov'),
('Libye','Afrique','true','Republique Parlementaire','Arabe','Aguila Salah Issa'),
('Republique democratique du Timor oriental','Oceanie','true','Republique','Portugais','Francisco Guterres'),
('Russie','Asie','true','Republique Federale','Russe','Vladimir Poutine'),
('Papouasie-Nouvelle-Guinee','Oceanie','true','Monarchie Constitutionnelle','Anglais','Bob Dadae'),
('Montenegro','Europe','true','Republique Parlementaire','Montenegrin','Filip Vujanović'),
('Moldavie','Europe','false','Republique Parlementaire','Roumain','Igor Dodon'),
('Maldives','Asie','true','Republique','Maldivien','Abdulla Yameen Abdul Gayoom'),
('Trinite-et-Tobago','Amerique du Sud','true','Republique','Anglais','Anthony Carmona'),
('Tadjikistan','Asie','false','Republique','Tadjik','Emomalii Rahmon'),
('Swaziland','Afrique','true','Monarchie Absolue','Swati','Mswati II'),
('Sri Lanka','Asie','true','Republique','Cingalais','Maithripala Sirisena'),
('Mexique','Amerique-centrale','true','Republique Presidentielle Federale','Espagnol','Enrique Peña Nieto'),
('Republique du Congo','Afrique','true','Republique','Francais','Denis Sassou-Nguesso'),
('Guinee equatoriale','Afrique','true','Republique','Espagnol','Teodoro Obiang Nguema Mbasogo'),
('Zimbabwe','Afrique','false','Republique Presidentielle','Anglais','Emmerson Mnangagwa'),
('Rwanda','Afrique','false','Republique','Kinyarwanda','Paul Kagame'),
('Lesotho','Afrique','false','Monarchie Constitutionnelle','Sesotho','Letsie III'),
('Côte d Ivoire','Afrique','true','Republique Constitutionnelle Unitaire Presidentielle','Francais','Alassane Ouattara'),
('Haïti','Amerique du Nord','true','Republique','Creole Haïtien','Jovenel Moïse'),
('Samoa','Oceanie','true','Democratie Parlementaire','Samoan','	Va aletoa Sualauvi II'),
('Nepal','Asie','false','Republique Federale','Nepalais','Bidya Devi Bhandari'),
('Bresil','Amerique du Sud','true','Republique Presidentielle Federale','Portugais','Michel Temer'),
('Mongolie','Asie','false','Republique','Mongol','Khaltmaagiyn Battulga'),
('Malawi','Afrique','false','Republique','Anglais','Peter Mutharika'),
('Madagascar','Afrique','true','Republique Constitutionnelle Semi-presidentielle','Malgache','Hery Rajaonarimampianina'),
('Ghana','Afrique','true','Republique','Anglais','Nana Akufo-Addo'),
('Georgie','Asie','true','Republique','Georgien','Guiorgui Margvelachvili'),
('Estonie','Europe','true','Republique Parlementaire','Estonien','Kersti Kaljulaid'),
('Senegal','Afrique','true','Republique Semi-presidentielle','Wolof','Macky Sall'),
('Chine','Asie','true','Republique Etat Communiste','Chinois mandarin','Xi Jinping'),
('Royaume-Uni','Europe','true','Monarchie Constitutionnelle Parlementaire Unitaire','Anglais','Theresa May'),
--Les pays qu'il manquait
('Niue','Oceanie','true','Monarchie Constitutionnelle','Anglais','Jerry Mateparae'),
('Somaliland','Afrique','true','Republique Presidentielle','Somali','Muse Bihi Abdi'),
('Guyana','Amerique du Sud','true','Republique','Anglais','David Granger'),
('Paraguay','Amerique du Sud','false','Republique','Espagnol','Horacio Cartes'),
('Kiribati','Oceanie','true','Republique Parlementaire','Anglais','Taneti Maamau'),
('Tuvalu','Oceanie','true','Monarchie Constitutionnelle','Tuvaluan','Iakoba Italeli'),
('Soudan du Sud','Afrique','false','Republique Federale','Anglais','Salva Kiir');


alter table pays drop regime_politique;
-- alter table pays drop personne_politique;

drop table if exists prefixe;
drop table if exists questions_prefixes;
create table prefixe(
	id serial primary key,
	prefixe text
);
create table questions_prefixes(
	id_prefixe integer,
	colonne text
);
create table match(
	pseudo text,
	id_table integer,
	poids float
);

insert into prefixe(prefixe) values 
	('Votre pays a-t-il pour langue officielle'),
	('Votre pays provient il du continent'),
	('Votre pays a-t-il un acces a la mer'),
	('Votre drapeau contient-il un(e) ou des'),
	('Votre drapeau contient-il la couleur'),
	('Votre pays a-t-il pour personnage politique');

insert into questions_prefixes(id_prefixe,colonne) values 
	('1','langue_officielle'),
	('3','acces_a_la_mer'),
	('2','continent'),
	('5','couleur'),
	('4','symbole'),
	('4','forme'),
	('6','personne_politique');

delete from pays_symboles where id_symbole='15';
-- delete from symbole where symbole='Aucun';
-- delete from forme where forme='Plat';
-- delete from forme where forme='en X';
delete from pays_formes where id_forme='5' or id_forme='6';