SELECT country.country as country,
    COUNT(customer.customer_id) as total_number_of_customer
FROM country
    INNER JOIN city ON city.country_id = country.country_id
    INNER JOIN address ON address.city_id = city.city_id
    INNER JOIN customer ON customer.address_id = address.address_id
GROUP BY country.country_id;
SELECT country.country as country,
    city.city as city,
    COUNT(customer.customer_id) as total_number_of_customer
FROM country
    INNER JOIN city ON city.country_id = country.country_id
    INNER JOIN address ON address.city_id = city.city_id
    LEFT JOIN customer ON customer.address_id = address.address_id
GROUP BY address.city_id, city.city
ORDER BY city DESC
SELECT DATE_FORMAT(rental_date, "%M-%Y") AS month_and_year,
    SUM(payment.amount) AS total_rental_amount,
    COUNT(payment.payment_id) AS tota_transactions,
    AVG(payment.amount) AS average_rental_amount
FROM rental
    INNER JOIN payment ON rental.rental_id = payment.rental_id
GROUP BY month_and_year
SELECT TIME_FORMAT(payment.payment_date, '%h %p') as hour_of_the_day,
    SUM(payment.amount) as total_payments_received
FROM payment
GROUP BY hour_of_the_day
ORDER BY total_payments_received DESC
LIMIT 10
