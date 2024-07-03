SELECT name
FROM people
WHERE id IN (SELECT DISTINCT directors.person_id FROM directors JOIN ratings ON ratings.movie_id = directors.movie_id WHERE ratings.rating >= 9.0);

