SELECT country.Continent as continent,
    COUNT(country.Name) as total_countries,
    country.LifeExpectancy as LifeExpectancy
FROM country
WHERE country.LifeExpectancy > 70
GROUP BY Continent;
SELECT country.Continent as continent,
    COUNT(country.Name) as total_countries,
    country.LifeExpectancy as LifeExpectancy
FROM country
WHERE country.LifeExpectancy BETWEEN 60 AND 70
GROUP BY Continent;
SELECT country.Name as country,
    country.LifeExpectancy as lifeexpectancy
FROM country
WHERE LifeExpectancy > 75;
SELECT country.Name as country,
    country.LifeExpectancy as lifeexpectancy
FROM country
WHERE LifeExpectancy < 40;
SELECT country.Name as country,
    country.Population as populations
FROM country
ORDER BY country.Population DESC
LIMIT 10;
SELECT SUM(country.Population) as total_population
FROM country;
SELECT country.Continent as continent,
    SUM(country.Population) as total_population
FROM country
GROUP BY Continent
HAVING total_population > 500000000;
SELECT country.Continent as continent,
    COUNT(country.Name),
    SUM(country.Population) as total_population,
    AVG(country.LifeExpectancy) as life_expectancy
FROM country
GROUP BY Continent
HAVING life_expectancy < 71;
SELECT country.Name as country,
    COUNT(city.Name) as number_of_cities
FROM country
    INNER JOIN city ON city.CountryCode = country.Code
GROUP BY country;
SELECT country.Name as country,
    countrylanguage.Language as language,
    COUNT(country.Name) as number_of_countries
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
GROUP BY countrylanguage.Language;
SELECT countrylanguage.Language as language,
    COUNT(country.Name) as total_countries,
    countrylanguage.IsOfficial as isofficial
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.IsOfficial = "T"
GROUP BY countrylanguage.Language;
SELECT countrylanguage.Language as language,
    SUM(
        (country.Population * countrylanguage.Percentage) / 100
    ) AS total_population
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
GROUP BY countrylanguage.Language
ORDER BY total_population DESC