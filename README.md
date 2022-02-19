# symfony_5_shopping_cart

Prerequisites:
  - PHP 7.2.5+
  - composer

Installation:
  - git clone https://github.com/peripurnomo/symfony_5_shopping_cart/
  - cd symfony_5_shopping_cart
  - composer install
  - php bin/console doctrine:database:create
  - php bin/console doctrine:schema:update --force
  - php bin/console doctrine:fixtures:load
  - php -S localhost:8000 -t public/
