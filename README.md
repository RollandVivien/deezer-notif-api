# deezer-notif-api

`composer install`

Modifier le fichier .env à la racine pour paramétrer la bdd. Par défault à DATABASE_URL=mysql://root:@127.0.0.1:3306/deezer-notif-api

`php bin/console doctrine:database:create`

`php bin/console doctrine:migrations:migrate`

`php bin/console doctrine:database:import "src/DataFixtures/deezer-notif-api.sql"` 

Pour importer la bdd de test.

---

`symfony serve`

Démarrer le serveur avec Symfony Local Web Server https://symfony.com/doc/current/setup/symfony_server.html .

---

Url disponible :

- GET /api/notifications - simule le résultat pour l'utilisateur connecté (utilisateur 1) - retourne un code 200

- POST /api/notification/seen - permet de passer manuellement une notification comme "vue" - retourne un code 204 ou 405 - doit prendre un paramètre "id"

- N'importe quelle autre url retourne un code 404
