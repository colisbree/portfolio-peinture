# Peintures

Site internet présentant des peintures


## Environnement de développement

### Pré-Requis

* PHP 7.4
* Composer
* Symfony CLI
* Docker
* Docker-compose
* NodeJS et NPM

Vous pouvez vérifier les pré-requis (sauf docker) avec la commande suivante :

```bash
symfony check:requirements
```

### Lancer l'environnement de développement

```bash
composer install
npm install
npm run build
docker-compose up -d
symfony serve -d
```
### Ajouter des données de test

```bash
Symfony console doctrine:fixtures:load
```

### Lancer des tests

```bash
Php bin/phpunit --testdox
```

