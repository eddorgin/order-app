bin/console doctrine:database:create -q
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load -q
yarn install
yarn encore dev