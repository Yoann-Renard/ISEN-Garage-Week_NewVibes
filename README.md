
# Titre du projet : "Mise en place d'un écoquartier : LisenValley"

## Slogan : " Une énergie durable entre nous, l’ambition partagé ".

### Paragraphe résumant le projet
"  Le projet consiste à mettre en place un écoquartier dans la ville du Pradet dans une démarche écologique.
En effet, le mandataire de ce projet est la ville du Pradet, qui, dans une volonté de redynamisation écologique a demandé aux élèves de l'ISEN Toulon de trouver une solution qui répond aux besoins fixés par la ville.
 Ce projet consiste en un écoquartier appelé LisenValley.
Chaque logement sera équipé d'un panneau solaire ainsi que de deux petites éoliennes afin de générer de l'électricité durablement.
Cela permettra de stocker de l'énergie dans des batteries en fonction de la quantité d'énergie générée, de s'auto-alimenter en électricité mais également de redistribuer un surplus de production à la ville lorsque les batteries sont pleines."

### Démarrage :
 Les différentes étapes pour faire fonctionner le prototype sont :
	étape 1 : aller sur le site internet
	etape 2 : se connecter en rentrant son identifiant et son mot de passe
	étape 3 : observer la production d'énergie des panneaux solaires et des éoliennes.
		  De meme, il est possible d'observer l'énergie restante dans la  batterie collective et l'énergie encore consommable par logement.
	étape 4 : Appuyer sur le bouton poussoir afin de similuer la consommation énergétique d'une maison
	étape 5 : Idem que l'étape 3 avec la possibilité d'observer la consommation énergétique en direct


### Arborescence :
TLN_Equipe9_New Vibes--> Livrable --> COMPTE RENDU TEXHNIQUE --> PROJET_ECOQUARTIER
		--> dossier arduino --> LANCER le fichier arduino  projet.ino
		--> dossier site WEB_BDD -->Un WebServer doit être installé sur la machine pour pouvoir ouvrir les pages de l'application

L'utilisateur arrive directement sur la page App/pages_php/Login.php,
il doit se connecter pour pouvoir avoir accès aux différentes pages le concernant

La page Login utilise une fonction "fonctions_php/validation.php" pour vérifier le compte
de l'utilisateur enregistré dans la base de données "new vibe db" et une fonction "scripts/script_formulaire js"
afin de mieux géré les animations.

les différentes pages "Dashboard_id=?" utilise "App/css" pour la mise en page et la fonction "fonctions_php/Logout.php" pour la déconnection.
Elles effectuent réguliairement des requêtes php afin d'avoir accés a la base de données.

Le micro controlleur effectue des requêtes http sur la page "fonctions_php/post-esp-data.php" afin de remplir la base de données.



### Auteurs :
- CORRE Johanna -- DEMASI Thibault -- RENARD Yoann -- COLLODET Laeticia -- TAZARINE Enzo -- DUBOIS Théo,
- New Vibe,
- 2020-2021
