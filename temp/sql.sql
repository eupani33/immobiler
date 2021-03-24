UPDATE ecriture SET categorie_id = 1, local_id= 5 WHERE libelle = 'MOUSSIER Robert'










Select e.date, e.type, e.libelle, e.montant, e.pointage, c.categorie, l.nom 
FROM ecriture e 
JOIN categorie c ON e.categorie_id = c.id 
JOIN local l ON e.local_id = l.id 