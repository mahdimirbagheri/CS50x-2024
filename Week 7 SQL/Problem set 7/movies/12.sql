SELECT title FROM movies
JOIN stars ON movies.id = stars.movie_id
JOIN people ON stars.person_id = people.id
WHERE name = "Bradley Cooper" AND title IN (SELECT title FROM movies JOIN stars ON movies.id = stars.movie_id JOIN	 people ON stars.person_id = people.id WHERE name = 'Jennifer Lawrence')
ORDER BY movie_id;
