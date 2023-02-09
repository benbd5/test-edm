# Test EDM

### Installation

    composer install

### Base de données

    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate

### Lancement de la commande

    php bin/console app:movie-xml