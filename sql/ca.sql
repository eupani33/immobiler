SELECT  SUM(montant) FROM   ecriture
WHERE  date LIKE '2021-03-%' AND categorie_id BETWEEN 1 and 4;

 


SELECT YEAR(date) AS an,
      	SUM(CASE WHEN MONTH(date) = 1 THEN montant ELSE 0 END) Jan,   
        SUM(CASE WHEN MONTH(date) = 2 THEN montant ELSE 0 END) Feb,    
        SUM(CASE WHEN MONTH(date) = 3 THEN montant ELSE 0 END) Mar,
        SUM(CASE WHEN MONTH(date) = 4 THEN montant ELSE 0 END) Avril,
      	SUM(CASE WHEN MONTH(date) = 5 THEN montant ELSE 0 END) Mai,
        SUM(CASE WHEN MONTH(date) = 6 THEN montant ELSE 0 END) Juin,
        SUM(CASE WHEN MONTH(date) = 7 THEN montant ELSE 0 END) Juil,
        SUM(CASE WHEN MONTH(date) = 8 THEN montant ELSE 0 END) Avril,
        SUM(CASE WHEN MONTH(date) = 9 THEN montant ELSE 0 END) Sept,
        SUM(CASE WHEN MONTH(date) = 10 THEN montant ELSE 0 END) Oct,
        SUM(CASE WHEN MONTH(date) = 11 THEN montant ELSE 0 END) Nov,
        SUM(CASE WHEN MONTH(date) = 12 THEN montant ELSE 0 END) `Dec`, 
   	    SUM(montant) as chiffre_affaire_par_an 
FROM ecriture 
WHERE categorie_id BETWEEN  1 AND 4
group by an 