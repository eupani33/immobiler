SELECT
  SUM(montant) AS somme_totale
FROM
  ecriture
WHERE
  YEAR(date) = EXTRACT (
    YEAR
    FROM
      CURRENT_DATE
  )
  AND MONTH(date) = MONTH (CURRENT_DATE) -2