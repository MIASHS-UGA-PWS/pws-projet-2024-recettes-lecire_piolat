# Guide d'installation du projet 

### Clone du git
```bash
git clone git@github.com:MIASHS-UGA-PWS/pws-projet-2024-recettes-lecire_piolat.git #en ssh
git clone https://github.com/MIASHS-UGA-PWS/pws-projet-2024-recettes-lecire_piolat.git #en https  
```
### Dépendances (hors composer install)
```bash
sudo apt-get install php-gd #necessaire pour la manip d'images, pour le captcha
sudo apt-get install php8.1-dom
sudo apt-get install php8.1-xml
sudo apt-get install php8.1-curl

sudo service apache2 restart #redemarrer
composer update
```
### Installation des dépendances, environnement de travail et génération de l'application key 
```bash
composer require mews/captcha #ne devrait pas etre necessaire
composer install
cp .env.example .env    
php artisan key:generate
```

### Base de données
```bash
touch database/database.sqlite
```
**Modifier .env :**
```php
DB_DATABASE=chemin/complet/vers/database/database.sqlite
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=larasite
# DB_USERNAME=root
# DB_PASSWORD=ic2a
```
**Lancement des migrations et seed :**
```bash
php artisan migrate
php artisan db:seed 
``` 

### Installer NodeJS v20 et vite v10 
```bash
sudo apt install curl
curl -fsSL https://deb.nodesource.com/setup_14.x | sudo -E bash -

sudo apt-get install -y nodejs
npm install
npm install @vitejs/plugin-vue
```  
### Lancer les serveurs 
```bash
npm run dev
php artisan serve
```
## Parties implémentées - Branche main
- **Gestion des notes**  
    - Les utilisateurs peuvent attribuer une note (de 1 à 5) à une recette et la modifier. Les notes sont enregistrées en base de données et affichées sur la page de chaque recette. La moyenne des notes est calculée et affichée pour chaque recette.  
  
- **Ajout d'images**
    - Les utilisateurs peuvent upload une image pour chaque recette. Aller sur ```/recettes/url_de_la_recette``` en clickant sur le titre d'une recette, charger une image, et clicker sur le bouton "Upload l'image". L'image s'affiche ensuite sur le frontend.

- **formulaire captcha** 
    - Un formulaire captcha a été ajouté sur la page de commentaire et l'utilisateur doit saisir correctement le résultat de l'équation dans l'image pour valider le formulaire.
    - Le package "mews/captcha" est déjà installé avec la commande composer require mais il faut installer les dépendances GD2 DLL (php_gd2.dll), php_fileinfo.dll et php_mbstring.dll dans le fichier php.ini si vous utilisez Windows.

### Changer de branche, migrer et seed à nouveau
```bash
git stash #au cas où il y ait des modifications à stash
git checkout vue
php artisan migrate:fresh --seed
```

## Fonctions implémentées : branche vue  

- **Barre de recherche** : Une recherche dans la barre de recherche (dans la navbar) affiche les recettes qui ont le contenu recherché dans leurs titres, leurs tags ou leurs ingrédients. On peut aussi faire une recherche en clickant sur des ingrédients ou des tags.

- **Gestion des commentaires** :  formulaire de création d'un commentaire et affichage de la liste des commentaires
    - visible dans la vue Single.vue, à l'url ```/recettes/{recette.url}``` accessible en clickant sur le titre d'une recette  

- **Gestion des tags** : 
    - voir ```/tags``` (ou clicker sur "Tags" dans la navbar) pour afficher une liste des tags. Clicker sur un tag pour afficher toutes les recettes qui contiennent ce tag.    

- **Gestion des ingrédients**
    - **Tester la création et édition de recettes.** Se trouvent aux URL ```/admin/recettes/create``` et ```/admin/recettes/edit``` (page admin dispo dans la navbar)
    - Clicker sur les boutons "Ajouter" et "Supprimer" pour ajouter, supprimer, modifier les ingrédients qu'on souhaite associer à la recette. Si un ingrédient n'existait pas dans la db, il est créé. S'il existait déjà, il est rattaché à la recette. Dans le formulaire de création, les noms des ingrédients ne sont pas sensibles à la casse : si l'ingrédient "Fromage" existe déjà dans la db, vous pouvez écrire "fromage" ; la recette sera bien reliée à l'entrée "Fromage" de la table "ingredients" de la base de données.

- **CRUD des recettes améliorées**
    - Dans les components Vue, on a lié les input aux data properties. Les vues contiennent les méthodes de soumission de formulaire.
  
- **Utilisation d'Inertia avec composants en vue**
    - les routes pointent vers des controllers qui renvoient des vues Inertia. Ces vues inertia sont des composants Vue.js. Le composant Modal.vue, par exemple, est utilisé pour ouvrir une fenêtre modale qui display une recette.
    - **clicker sur le titre d'une recette depuis la page d'accueil, ou depuis** ```/recettes```  pour voir la fenêtre modale.

- **Utilisation du framework Vue.js**
    - On n'utilise aucune vue blade dans cette branche. Les composants Vue.js utilisent les fonctionnalités de Vue.js, comme les propriétés réactives, les directives ```v-model```, ```v-for```, ```v-if```, ou encore les méthodes de soumissions de formulaire.  

