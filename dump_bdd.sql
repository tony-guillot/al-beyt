SELECT titre, date_evenement, image_evenement.chemin, artiste.nom
FROM evenement
INNER JOIN artiste_evenement ON evenement.id = artiste_evenement.id_evenement
INNER JOIN artiste ON artiste.id = artiste_evenement.id_artiste
INNER JOIN image_evenement ON evenement.id = image_evenement.id_evenement
WHERE image_evenement.ordre = 1
AND YEAR(evenement.date_evenement) = "2021"; 

INSERT INTO domaine (nom) VALUES
("Musique"),
("Tonique"),
("Plastique");

INSERT INTO artiste (nom, description,lien_insta, lien_soundcloud, lien_facebook, lien_twitter, id_domaine) VALUES
("Leroy","Le seul roy","instagram.com/leroy","soundcloud.com/leroy", "facebook.com/leroy","twitter.com/leroy",1),
("Joseph","Le grand Joseph","instagram.com/joseph","soundcloud.com/joseph", "facebook.com/joseph","twitter.com/joseph",2),
("Anette","La royale anette","instagram.com/anette","soundcloud.com/anette", "facebook.com/anette","twitter.com/anette",3)
;

INSERT INTO image_artiste (chemin,legende, id_artiste) VALUES
("https://media-exp1.licdn.com/dms/image/C5603AQG8k0N0gFfiEQ/profile-displayphoto-shrink_200_200/0/1528490138299?e=1660780800&v=beta&t=jugemeLmB8dqtAhGY42auk4BoOA9eZSFjE1xykuSUWU","photo de leroy",1),
("photo-de-joseph.com/photo.jpg","photo de joseph",2),
("photo-de-anette.com/photo.jpg","photo de anette",3)
;

INSERT INTO artiste_evenement (id_artiste, id_evenement) VALUES
(1,1),
(2,1),
(3,2)
;

INSERT INTO evenement (titre, adresse, date_evenement, heure, description) VALUES
("Fete de la saucisse", "3 Rue de la saucisse, 59200 Tourcoing", "31/12/22", "15h à 18h", "Venez manger des saucisses"),
("Foire du foutre", "12 Rue de la verge, 17089 Penisville", "12/07/22", "23h à 23h15", "Venez comme vous etes")
;

INSERT INTO image_evenement (chemin,legende, id_evenement, ordre) VALUES
("https://www.cdiscount.com/pdt2/8/6/7/1/1200x1200/auc6456415293867/rw/lot-de-20-cheveux-chouchous-en-velours-elastiques.jpg", "g besoin de chouchou", 1,1),
("https://www.aurismagnetic.com/1978-large_default/brosse-magnetique.jpg","pareil pour la brosse",1,2);

INSERT INTO utilisateur (identifiant,mot_de_passe) VALUES 
("admin","admin");

INSERT INTO article (titre,date,auteur,description) VALUES  
("La cliente la pute", "20/10/20","moi","y'a trop de dans les stores, jpeux pas aider tout les clients"),
("Leroy au moins d'argent","20/10/21","lui-même","prepare fetch execute return"),
("Jean de la fontaine retrouvé noyé dans la fontaine","20/10/22","yeah","jean de la fontaine blablabla");

INSERT INTO image_article (chemin,legende,id_article, ordre) VALUES
("https://www.google.com/search?q=salade&newwindow=1&client=firefox-b-d&sxsrf=ALiCzsZGcT4DMNDGfhqQsOFdO5_YpQkm7g:1655717177971&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjP-faR27v4AhUE0oUKHf2eBcoQ_AUoAnoECAEQBA&biw=1296&bih=628&dpr=2.22#imgrc=m5mYVOia2Kgy_M","salade sans tomate sans oignon",4,1),
("https://www.ikea.com/fr/fr/p/lerhamn-chaise-teinte-antique-clair-vittaryd-beige-20259423/","1 par personne",4,2);

