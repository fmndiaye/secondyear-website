Pour lancer l'algorithme(base de donn�es en psql):
	--initialisation
	CREATE USER genie3 WITH PASSWORD 'genie3' CREATEDB;
	CREATE DATABASE genie3 WITH OWNER genie3;
	
	\i Tables.sql (dans la base de donn�e genie3)
	\i Site.sql
	\i Sportifs.sql

	--lancement
	ouvrir index.php (heberg� en localhost pour nous)


