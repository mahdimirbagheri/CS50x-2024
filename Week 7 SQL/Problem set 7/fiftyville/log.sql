-- Keep a log of any SQL queries you execute as you solve the mystery.
-- A description of the theft has occurred.
SELECT description
FROM crime_scene_reports
WHERE year = 2023 AND month = 7 AND day = 28 AND street = 'Humphrey Street';
-- Find the names of the interviewees.
SELECT name, transcript
FROM interviews
WHERE year = 2023 AND month = 7 AND day = 28;
-- Find how many people are named Eugene.
SELECT name
FROM people
WHERE name = 'Eugene';
-- Witnesses who used the word bakery in their testimony.
SELECT name, transcript
FROM interviews
WHERE year = 2023 AND month = 7 AND day = 28 AND transcript LIKE '%bakery%'
ORDER BY name;
-- The clue given by Eugene : People who used ATM that day?
SELECT account_number, amount
FROM atm_transactions
WHERE year = 2023 AND month = 7 AND day = 28 AND atm_location = 'Leggett Street' AND transaction_type = 'withdraw';
-- Find the names of people who have withdrawn from ATM using their account number.
SELECT name, atm_transactions.amount
FROM people
JOIN bank_accounts
ON people.id = bank_accounts.person_id
JOIN atm_transactions
ON bank_accounts.account_number = atm_transactions.account_number
WHERE atm_transactions.year = 2023 AND atm_transactions.month = 7 AND atm_transactions.day = 28 AND atm_transactions.atm_location = 'Leggett Street' AND atm_transactions.transaction_type = 'withdraw';
-- A clue that Raymond raised : s the thief was leaving the bakery, they called someone who talked to them for less than a minute. In the call, I heard the thief say that they were planning to take the earliest flight out of Fiftyville tomorrow. The thief then asked the person on the other end of the phone to purchase the flight ticket
-- Flights originating from Fiftyville.
SELECT abbreviation, full_name, city
FROM airports
WHERE city = 'Fiftyville';
-- Find details of flights to Fiftyville.
SELECT flights.id, full_name, city, flights.hour, flights.minute
FROM airports
JOIN flights
ON airports.id = flights.destination_airport_id
WHERE flights.origin_airport_id = (SELECT id FROM airports WHERE city = 'Fiftyville') AND flights.year = 2023 AND flights.month = 7 AND flights.day = 29
ORDER BY flights.hour, flights.minute;
-- Find the passenger list for flights from Fiftyville to New York City.
SELECT passengers.flight_id, name, passengers.passport_number, passengers.seat
FROM people
JOIN passengers
ON people.passport_number = passengers.passport_number
JOIN flights
ON passengers.flight_id = flights.id
WHERE flights.year = 2023 AND flights.month = 7 AND flights.day = 29 AND flights.hour = 8 AND flights.minute = 20
ORDER BY passengers.passport_number;
-- Checking calls that are shorter than one minute.
SELECT name, phone_calls.duration
FROM people
JOIN phone_calls
ON people.phone_number = phone_calls.caller
WHERE phone_calls.year = 2023 AND phone_calls.month = 7 AND phone_calls.day = 28 AND phone_calls.duration <= 60
ORDER BY phone_calls.duration;
-- The names of those who have been contacted.
SELECT name, phone_calls.duration
FROM people
JOIN phone_calls
ON people.phone_number = phone_calls.receiver
WHERE phone_calls.year = 2023 AND phone_calls.month = 7 AND phone_calls.day = 28 AND phone_calls.duration <= 60
ORDER BY phone_calls.duration;
-- The number plates of the cars that were in the parking lot of the bakery.
SELECT name, bakery_security_logs.hour, bakery_security_logs.minute
FROM people
JOIN bakery_security_logs
ON people.license_plate = bakery_security_logs.license_plate
WHERE bakery_security_logs.year = 2023 AND bakery_security_logs.month = 7 AND bakery_security_logs.day = 28 AND bakery_security_logs.activity = 'exit' AND bakery_security_logs.hour = 10 AND bakery_security_logs.minute >= 15 AND bakery_security_logs.minute <= 25
ORDER BY bakery_security_logs.minute;
-- Bruce was present at all the inquiries and he is guilty and when talking on the phone the only person who spoke to Bruce at the same level is Robin
