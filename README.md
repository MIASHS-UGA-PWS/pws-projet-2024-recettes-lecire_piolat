## Guide d'installation du projet 

### Prerequisites
Avoir PHP, Composer, Node.js, et npm.


### Clone du git, installer les dépendences, environnement de travail et generation de l'application key 
```bash
    git clone git@github.com:MIASHS-UGA-PWS/pws-projet-2024-recettes-lecire_piolat.git
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
```

### Captcha Service Provider
    (composer require mews/captcha) déjà installé avec la commande composer install.
    Si utilisation avec Windows, inclure le GD2 DLL php_gd2.dll dans php.ini ainsi que php_fileinfo.dll et php_mbstring.dll

### Setup Sqlite dans .env avec le chemin absolu de la database
    DB_DATABASE=/ABSOLUTE_PATH/database/database.sqlite

### Lancement des migrations et du seeder
    php artisan migrate
    php artisan db:seed  
  
### Aller sur la branche vue, qui implémente inertia avec VueJS
    git checkout vue

### Lancement des serveurs
    php artisan serve
    npm run dev

## Parties implémentées - Branche vue
- **barre de recherche :**
    La recherche via barre de recherche (dans la navbar) affiche les recettes qui contiennent le contenu recherché dans leurs titres, leurs tags ou leurs ingrédients.  

- **Gestion des commentaires :** formulaire de création d'un commentaire + affichage de la liste des commentaires
    - visible dans la vue Single.vue, à l'url ```/recettes/{recette.url}``` accessible en clickant sur le titre d'une recette

- **Gestion des tags**
    - voir ```/tags``` (clicker sur "Tags" dans la navbar) pour afficher une liste des tags. Clicker sur un tag pour afficher toutes les recettes qui contiennent ce tag. 
  
- **Gestion des ingrédients**
    - tester la création et édition de recettes. Se trouvent aux URL ```/admin/recettes/create``` et ```/admin/recettes/edit``` (page admin dispo dans la navbar)
    - On peut y ajouter, supprimer, modifier les ingrédients qu'on souhaite associer à la recette. Si un ingrédient n'existait pas dans la db, il est créé. S'il existait déjà, il est rattaché à la recette.

- **CRUD des recettes améliorées**
    - Dans les components Vue.js, on lie les input aux data properties. Les vues contiennent les méthodes de soumission de formulaire.
  
- **Utilisation d'Inertia avec composants en vue**
    - les routes pointent vers des controllers qui renvoient des vues Inertia. Ces vues inertia sont des composants Vue.js. Le composant Modal.vue, par exemple, est utilisé pour ouvrir une fenêtre modale qui display une recette. 

- **Utilisation du framework Vue.js**
    - Les composants Vue.js utilisent les fonctionnalités de Vue.js, comme les propriétés réactives, les directives ```v-model```, ```v-for```, ```v-if```, ou encore les méthodes de soumissions de formulaire.  
  
## Parties implémentées - Branche main
- **Gestion des notes**  

- **formulaire captcha** 
  

## Fonctionnalités implémentées


## Remarques
