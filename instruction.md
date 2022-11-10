#Énoncé
## Traitement de formulaire en méthode POST & lien de redirection en GET (avec paramètre)

Vous devez créer un formulaire, qui va contenir 7 champs : 
- Un champ : name(text)
- Un champ : email(text)
- Un champ : year(text) de naissance
- Une liste de selection : job(text) max 4 choix
- Des checkbox : hobbies
- Un choix unique (radio) : ecolo ou pas
- Un champ multiligne(textarea) : description

Il faudra tester chaque champ puis les afficher, si une valeur parmis les 7 champs est vide, on affiche "Il y a une erreur".

Si tout les champs sont bien remplis, alors on affiche une liste (comme dans la démo) avec toutes les valeurs choisies

Bonus: 
- Use Regex | Filter (email, year)
- Faire 1 ou 2 balises <a> pour rediriger vers 1 ou 2 autres pages avec des paramètres pour bien comprendre le principe de récupération des paramètres d'url (GET) en prévision d'un futur `routing`