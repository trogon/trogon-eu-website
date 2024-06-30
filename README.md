## Symfony backend core
Install composer dependencies.
```bash
composer install
```

Check updates for composer (PHP)
```bash
composer outdated
```

Check symfony migration for updates (PHP)
```bash
composer recipes:update
```

Prepare configuration for development.
```bash
composer dump-env dev
```

Vefiy if current configuration is complete.
```bash
php bin/console debug:container --env-vars
```

Clear runtime cache.
```bash
php bin/console cache:clear
```

Install assets
```bash
php bin/console assets:install public
```

Run all tests.
```bash
php bin/phpunit
```

Run all tests in Form directory.
```bash
php bin/phpunit tests/Form
```

Run tests in given file.
```bash
php bin/phpunit tests/Form/UserTypeTest.php
```

## React interactive UI

Install last LTS nodeJS.
```bash
nvm install lts
nvm use lts
```

Install yarn dependencies
```bash
corepack enable
yarn set version stable
yarn install
```

Produce encode JS output
```bash
# Script command
yarn build

# Full command
yarn run encore production

# Full command for dev
yarn run encore dev
```

Update Yarn packages
```bash
yarn upgrade-interactive
```