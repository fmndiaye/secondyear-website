Pour lancer l'algorithme(base de données en psql):
	--initialisation
	CREATE USER genie3 WITH PASSWORD 'genie3' CREATEDB;
	CREATE DATABASE genie3 WITH OWNER genie3;
	
	\i Tables.sql (dans la base de donnée genie3)
	\i Site.sql
	\i Sportifs.sql

	--lancement
	ouvrir index.php (hebergé en localhost pour nous)


