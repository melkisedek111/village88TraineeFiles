SELECT DATE_FORMAT(charged_datetime, "%M %Y") as month,
    SUM(billing.amount) as revenue
FROM billing
WHERE DATE_FORMAT(charged_datetime, "%M %Y") = "March 2012"
GROUP BY month;
SELECT clients.client_id as client,
    SUM(billing.amount) as total_revenue
FROM clients
    INNER JOIN billing ON clients.client_id = billing.client_id
WHERE clients.client_id = 2
GROUP BY client;
SELECT sites.domain_name as website,
    clients.client_id as client_id
FROM sites
    INNER JOIN clients ON clients.client_id = sites.client_id
WHERE sites.client_id = 10;
SELECT sites.client_id as client_id,
    COUNT(sites.domain_name) as number_of_websites,
    DATE_FORMAT(sites.created_datetime, "%M") as month_created,
    DATE_FORMAT(sites.created_datetime, "%Y") as year_created
FROM clients
    INNER JOIN sites ON sites.client_id = clients.client_id
WHERE sites.client_id = 1
GROUP BY sites.domain_name;
SELECT sites.client_id as client_id,
    COUNT(sites.domain_name) as number_of_websites,
    DATE_FORMAT(sites.created_datetime, "%M") as month_created,
    DATE_FORMAT(sites.created_datetime, "%Y") as year_created
FROM clients
    INNER JOIN sites ON sites.client_id = clients.client_id
WHERE sites.client_id = 20
GROUP BY sites.domain_name;
SELECT sites.domain_name as website,
    COUNT(leads.leads_id) as number_of_leads,
    DATE_FORMAT(leads.registered_datetime, '%M &d, %Y') as date_generated
FROM leads
    INNER JOIN sites ON leads.site_id = sites.site_id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-02-15'
GROUP BY sites.domain_name;
SELECT CONCAT(clients.first_name, ' ', clients.last_name) as client_name,
    COUNT(leads.leads_id) as number_of_leads
FROM leads
    INNER JOIN sites ON leads.site_id = sites.site_id
    INNER JOIN clients ON sites.client_id = clients.client_id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-12-31'
GROUP BY clients.client_id;
SELECT CONCAT(clients.first_name, ' ', clients.last_name) as client_name,
    COUNT(leads.leads_id) as number_of_leads,
    DATE_FORMAT(leads.registered_datetime, '%M') as month_generated
FROM sites
    INNER JOIN clients ON sites.client_id = clients.client_id
    INNER JOIN leads ON leads.site_id = sites.site_id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-06-30'
GROUP BY leads.registered_datetime;
SELECT CONCAT(clients.first_name, ' ', clients.last_name) as client_name,
    sites.domain_name as website,
    COUNT(leads.leads_id) as number_of_leads,
    DATE_FORMAT(leads.registered_datetime, '%Y %d, %M') as month_generated
FROM sites
    INNER JOIN clients ON sites.client_id = clients.client_id
    INNER JOIN leads ON leads.site_id = sites.site_id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-12-31'
GROUP BY sites.domain_name;
SELECT CONCAT(clients.first_name, ' ', clients.last_name) as client_name,
    sites.domain_name as website,
    COUNT(leads.leads_id) as number_of_leads
FROM leads
    LEFT JOIN sites ON leads.site_id = sites.site_id
    RIGHT JOIN clients ON sites.client_id = clients.client_id
GROUP BY sites.domain_name;
SELECT CONCAT(clients.first_name, ' ', clients.last_name) as client_name,
    SUM(billing.amount) as Total_Revenue,
    DATE_FORMAT(billing.charged_datetime, '%M') as month_charge,
    DATE_FORMAT(billing.charged_datetime, '%Y') as year_charge
FROM clients
    INNER JOIN billing ON clients.client_id = billing.client_id
GROUP BY DATE_FORMAT(billing.charged_datetime, '%M'),
    DATE_FORMAT(billing.charged_datetime, '%Y'),
    clients.client_id;
SELECT CONCAT(clients.first_name, ' ', clients.last_name) as client_name,
    GROUP_CONCAT(sites.domain_name SEPARATOR ' / ')
FROM clients
    LEFT JOIN sites ON clients.client_id = sites.client_id
GROUP BY clients.client_id