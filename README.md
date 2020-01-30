### Repositório utilizado no workshop

#### Iniciando:
- `git clone https://github.com/wagnermengue/unittest-workshop.git`
- `cd unittest`
- `composer install`

#### Comandos:
- `vendor/bin/phpunit tests`
- `vendor/bin/phpunit --bootstrap=vendor/autoload.php tests`
- `vendor/bin/phpunit tests --filter=CalculatorTest`
- `vendor/bin/phpunit tests --filter=testConvertDollarToReal`