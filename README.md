# Minicrm

Projet Minicrm
[![Build Status](https://badgen.net/badge/From/Louizy/blue?icon=bitcoin-lightning)](https://badgen.net/badge/From/Louizy/blue?icon=bitcoin-lightning)



## Tech

Minicrm utilise plusieurs projet open-source:

- [Laravel](https://laravel.com/)
- [Bootstrap](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [Datatable](https://datatables.net/)
- [Font-awesome](https://fontawesome.com/)

## Installation

Pour installer Minicrm:

1. Cloner le repository: `https://github.com/salah-l/minicrm-tersea`
2. Se rendre dans le dossier du projet : `cd minicrm-tersea`
3. Exécuter : `composer install`
4. Installer les modules npm: `npm install`
5. Créer le fichier .env: `copy .env.example .env`
6. Modifier DB_CONNECTION et MAIL_MAILER dans le fichier .env: 
```
DB_CONNECTION=sqlite
.
.
MAIL_MAILER=log
```
7. Générer la clé de l'application : `php artisan key:generate`
8. Créer les tables dans la base de données: `php artisan migrate` puis appuyer sur Entrée et saisir `yes`
9. Générer des données factices avec: `php artisan db:seed`
10. Dans un nouveau terminal, lancer le serveur Laravel: `php artisan serve`
11. Dans un autre terminal, lancer Vite: `npm run dev`
12. Dans votre navigateur, naviguer vers `http://localhost:8000`, et voila.


Pour vous connecter, voici des identifiants prédéfinis :

1.Pour Administrateur
```
email: admin@minicrm.com
Mot de passe: 123456789
```

```
email: karim@minicrm.com
Mot de passe: 123456789
```

2.Pour Employé
```
email: employee@company.com
Mot de passe: 123456789
```

```
email: nasser.r@company.com
Mot de passe: 123456789
```

Pour l'espace administrateur, lorsque vous envoyez une invitation à un employé, l'e-mail envoyé sera livré à  `./storage/laravel.log`



<img src="http://salah.louizy.com/images/louizy-logo.png" width="200"/>


