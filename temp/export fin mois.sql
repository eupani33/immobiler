SELECT
  date,
  type,
  libelle,
  montant,
  c.classe,
  c.categorie,
  l.nom
FROM
  ecriture e
  INNER JOIN local l ON e.local_id = l.id
  INNER JOIN categorie c ON e.categorie_id = c.id
  AND YEAR(date) = EXTRACT (
    YEAR
    FROM
      CURRENT_DATE
  )
  AND MONTH(date) = MONTH (CURRENT_DATE) -1