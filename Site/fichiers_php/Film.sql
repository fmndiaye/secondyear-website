create table sportif(
	year integer,
	city text,
	sport text,
	discipline text,
	athlete text,
	country text,
	gender text,
	event text,
	medal text
)

\copy movie from 'movies_metadata.csv' ( FORMAT CSV, DELIMITER(';') );