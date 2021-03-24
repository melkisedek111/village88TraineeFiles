SELECT *
FROM customer
WHERE customer.customer_id = 20;
SELECT *
FROM customer
WHERE customer.customer_id BETWEEN 20 and 60;
SELECT *
FROM customer
WHERE customer.first_name LIKE 'L%';
SELECT *
FROM customer
WHERE customer.first_name LIKE '%L%';
SELECT *
FROM customer
WHERE customer.first_name LIKE '%L';
SELECT *
FROM customer
WHERE customer.last_name LIKE 'C%'
ORDER BY create_date DESC;
SELECT customer_id,
    first_name,
    last_name,
    email
FROM customer
WHERE customer.customer_id IN (515, 181, 582, 503, 29, 85);
SELECT customer_id as customerId,
    first_name as firstName,
    last_name as lastName,
    email as email_address
FROM customer
WHERE customer.customer_id = 2;
SELECT first_name,
    last_name,
    email
FROM customer
ORDER BY email DESC;
SELECT customer_id,
    first_name,
    last_name,
    email
FROM customer
WHERE MONTH(create_date) = 2;
SELECT email,
    LENGTH(email) as email_length
FROM customer
ORDER BY email_length DESC,
    email ASC
SELECT email,
    LENGTH(email) as email_length
FROM customer
ORDER BY email_length ASC
LIMIT 100
