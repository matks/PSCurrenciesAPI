[![PHP tests](https://github.com/matks/PSCurrenciesAPI/actions/workflows/tests.yml/badge.svg)](https://github.com/matks/PSCurrenciesAPI/actions/workflows/tests.yml)


# PrestaShop Currencies API

Small php app that fetches currency rate from [Fixer.io](https://fixer.io/) and outputs a XML file

## Usage

No need to install dependencies

```
php fetchLatestRates.php <API_KEY> <OUTPUT_FILE>
```

## Implementation

This app was built on purpose without Composer, with no phpunit or phpstan or any other tool because it has a limited scope.

## Testing

```
php test/test1.php
php test/test2.php
php test/test3.php
```

or

```
$ tests/run.sh
```
