# deezer-notif-api

`composer install`

`php bin/console doctrine:database:create`

`php bin/console doctrine:database:import "src/DataFixtures/deezer-notif-api.sql"` 

pour importer la bdd de test

---

`symfony serve`

démarrer le serveur avec Symfony Local Web Server https://symfony.com/doc/current/setup/symfony_server.html

---

url disponible :

- GET /api/notifications - simule le résultat pour l'utilisateur connecté (utilisateur 1) - retourne un code 200

- POST /api/notification/seen - permet de passer manuellement une notification comme "vue" - retourne un code 204 ou 405 - doit prendre un paramètre "id"

- n'importe quelle autre url retourne un code 404
