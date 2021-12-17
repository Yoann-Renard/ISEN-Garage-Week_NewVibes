----------------------------------------------------------------------------------------------------------
Un WebServer doit être installé sur la machine pour pouvoir ouvrir les pages de l'application
----------------------------------------------------------------------------------------------------------

L'utilisateur arrive directement sur la page App/pages_php/Login.php,
il doit se connecter pour pouvoir avoir accès aux différentes pages le concernant

La page Login utilise une fonction "fonctions_php/validation.php" pour vérifier le compte
de l'utilisateur enregistré dans la base de données "new vibe db" et une fonction "scripts/script_formulaire js"
afin de mieux géré les animations.

les différentes pages "Dashboard_id=?" utilise "App/css" pour la mise en page et la fonction "fonctions_php/Logout.php" pour la déconnection.
Elles effectuent réguliairement des requêtes php afin d'avoir accés a la base de données.

Le micro controlleur effectue des requêtes http sur la page "fonctions_php/post-esp-data.php" afin de remplir la base de données.
