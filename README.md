# lestudiblog

## Comment utiliser le projet en local

Lancer l'invit de commandes puis cloner le projet:
```bash
git clone https://github.com/bertranddetre/lestudiblog.git
```
Créer une copie du .env en le nommant .env.local
  ```bash
  cp .env .env.local
  ```
Modifier le fichier .env.local afin de le rendre compatible avec votre environement (décommenter votre BDD avec laquelle vous travaillez, écrire votre identifiant, votre mot de passe et donnez un nom de projet ) 
 ```bash
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
 ```
puis installer les dépendances php:
```bash
composer install
```
Une fois le projet installé il faut créer la base de donnée :

```bash
symfony console doctrine:database:create
```

Jouer les migrations :

```bash
symfony console doctrine:migrations:migrate
```
Lancer les DataFixtures :

```bash
symfony console doctrine:fixture:load 
```
Lancer le projet:

```bash  
 symfony server:start
```

A NOTER:
> Vous pouvez remplacer la commande "symfony console" dans votre terminal par "php bin/console" si vous n'utilisez pas le "cli symfony"
## Se connecter à l'application

| email             | mot de passe  |
| ----------------- | --------------|
| tata@email.com    | test12345     |
 
