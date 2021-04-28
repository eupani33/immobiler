SELECT
  nom,
  categorie
FROM
  categorie ca
  INNER JOIN classe cl ON ca.classe_id = cl.id
ORDER BY
  cl.nom,
  ca.categorie;

