SELECT Code,
    Name,
    Continent,
    Region,
    SurfaceArea,
    IndepYear,
    Population,
    LifeExpectancy,
    GNP,
    GNPOld,
    LocalName
FROM country
WHERE Continent = "Europe";
SELECT Code,
    Name,
    Continent,
    Region,
    SurfaceArea,
    IndepYear,
    Population,
    LifeExpectancy,
    GNP,
    GNPOld,
    LocalName
FROM country
WHERE Continent IN ("North America", "Africa");
SELECT Code as country_code,
    country.Name as country_name,
    Continent as continent,
    country.Population as country_population,
    city.Name as city
FROM country
    INNER JOIN city ON city.CountryCode = country.Code
WHERE country.Population > 100000000;
SELECT country.Name as country,
    countrylanguage.Language as Language
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.Language = "Spanish";
SELECT country.Name as country,
    countrylanguage.Language as Language,
    isOfficial
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.Language = "Spanish"
    AND countrylanguage.IsOfficial = "T";
SELECT country.Name as country,
    countrylanguage.Language as Language
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.Language IN ("Spanish", "English")
    AND countrylanguage.IsOfficial = "T";
SELECT country.Name as country,
    countrylanguage.Language as Language,
    countrylanguage.Percentage,
    countrylanguage.IsOfficial as isofficial
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.Language = "Arabic"
    AND countrylanguage.IsOfficial = "F"
    AND countrylanguage.Percentage > 30;
SELECT country.Name as country,
    countrylanguage.Language as Language,
    countrylanguage.IsOfficial as isofficial,
    countrylanguage.Percentage
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.Language = "French"
    AND countrylanguage.IsOfficial = "T"
    AND countrylanguage.Percentage < 50;
SELECT country.Name as country,
    countrylanguage.Language as Language,
    countrylanguage.IsOfficial as isofficial
FROM country
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.IsOfficial = "T"
ORDER BY countrylanguage.Language ASC;
SELECT country.Name as country,
    city.Name as city,
    countrylanguage.Language as language,
    countrylanguage.IsOfficial as isofficial
FROM country
    INNER JOIN city ON city.CountryCode = country.Code
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.IsOfficial = "T"
ORDER BY city.Population DESC
LIMIT 100;
SELECT country.Name as country,
    country.LifeExpectancy as lifeexpectancy,
    city.Name as city,
    city.Population as population
FROM country
    INNER JOIN city ON city.CountryCode = country.Code
WHERE country.LifeExpectancy < 40
ORDER BY city.Population DESC
LIMIT 100;
SELECT country.Name as country,
    city.Name as city,
    country.LifeExpectancy as lifeexpectancy
FROM country
    INNER JOIN city ON city.CountryCode = country.Code
    INNER JOIN countrylanguage ON countrylanguage.CountryCode = country.Code
WHERE countrylanguage.Language = "English"
ORDER BY country.LifeExpectancy DESC
LIMIT 100;