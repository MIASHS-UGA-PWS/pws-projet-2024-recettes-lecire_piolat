## Guide d'installation du projet 
avec toutes les commandes à exécuter et les fichiers à configurer : git clone ... , composer install, npm install, modification du fichier .env, lancement des migrations, lancement du ou des serveurs, etc. 

### Clone du git, Gestionnaire de dependances, environnement de travail et generation de l'application key 
    git clone git@github.com:MIASHS-UGA-PWS/pws-projet-2024-recettes-lecire_piolat.git
    composer install    
    cp .env.example .env    
    php artisan key:generate

### Captcha Service Provider
    composer require mews/captcha
    Si utilisation avec Windows, inclure le GD2 DLL php_gd2.dll dans php.ini ainsi que php_fileinfo.dll et php_mbstring.dll

## Setup Sqlite
    DB_DATABASE=/ABSOLUTE_PATH/database/database.sqlites

### Lancement des migrations et du seeder
    php artisan migrate
    php artisan db:seed

### Lancement du serveur
    php artisan serve

### Lancement du serveur pour Vue.js
    npm run dev

## Parties implémentées
- **Gestion des commentaires :** formulaire de création d'un commentaire + affichage de la liste des commentaires
    - visible dans la vue single, à l'url ```/recettes/{recette.url}```

- **Gestion des tags**
    - voir ```/tags``` (accessible depuis la navbar) pour afficher une liste des tags. Clicker sur un tag pour afficher toutes les recettes qui contiennent ce tag.  
  
- **Gestion des ingrédients**
    - tester la création et édition de recettes. Se trouvent aux URL ```/admin/recettes/create``` et ```/admin/recettes/edit``` (page admin dispo dans la navbar)
    - On peut y ajouter, supprimer, modifier le nombre d'ingrédients qu'on souhaite associer à la recette. Si un ingrédient n'existait pas dans la db, il est créé. S'il existait déjà, il est rattaché à la recette.  
  
- **Gestion des notes**  

- **formulaire captcha** 
  
- **branche vue -** CRUD des recettes améliorées  
    - Dans les components Vue.js, on lie les input aux data properties. Les vues contiennent les méthodes de soumission de formulaire
        - par exemple, dans AdminCreateRecette.vue, les data properties sont ```success``` et ```newRecipeData```, qui est un objet qui contient les données de la nouvelle recette à créer. Le formulaire est lié à la méthode ```createRecipe()``` qui envoie une requête POST avec les données de ```newRecipeData```.  
  
- **branche vue -** Utilisation d'Inertia avec composants en vue
    - les routes pointent vers des controllers qui renvoient des vues Inertia. Ces vues inertia sont des composants Vue.js. On a utilisé des composants fournis par Inertia, comme les balises ```<Link>```.

- **branche vue -** Utilisation du framework Vue.js
    - Les composants Vue.js utilisent les fonctionnalités de Vue.js, comme les propriétés réactives (comme ```success```ou ```newRecipeData```), les directives ```v-model```, ```v-for```, ```v-if```, ou encore les méthodes de soumissions de formulaire.

## Fonctionnalités implémentées


## Remarques
Optionnel
