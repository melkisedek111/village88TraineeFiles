SELECT *
FROM customer;
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    address
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id;
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    address,
    city
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id;
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    address,
    city,
    country
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE country = "Bolivia";
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    address,
    city,
    country
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE country IN ('Bolivia', 'Germany', 'Greece');
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    address,
    city,
    country
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE city = 'Baku';
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    address,
    city,
    country
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE city IN ('Baku', 'Beira', 'Bergamo');
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    country,
    LENGTH(country) AS country_name_length
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE LENGTH(country) < 5
ORDER BY LENGTH(CONCAT(first_name, ' ', last_name)) DESC;
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    country,
    city,
    LENGTH(city) AS city_name_length
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE LENGTH(city) > 10
ORDER BY country ASC;
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    city
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE city LIKE "%ba%";
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    city,
    LENGTH(city) AS city_name_length
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE city LIKE "% %"
ORDER BY city_name_length DESC;
SELECT CONCAT(first_name, ' ', last_name) AS customer_name,
    city,
    country,
    LENGTH(city) AS city_name_length,
    LENGTH(country) AS country_name_length
FROM customer
    INNER JOIN address ON customer.address_id = address.address_id
    INNER JOIN city ON city.city_id = address.city_id
    INNER JOIN country ON country.country_id = city.country_id
WHERE LENGTH(country) > LENGTH(city)