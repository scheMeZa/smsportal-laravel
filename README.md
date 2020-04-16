# SMSPortal Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/schemeza/smsportal-laravel.svg?style=flat-square)](https://packagist.org/packages/schemeza/smsportal-laravel)
[![Build Status](https://img.shields.io/travis/schemeza/smsportal-laravel/master.svg?style=flat-square)](https://travis-ci.org/schemeza/smsportal-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/schemeza/smsportal-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/schemeza/smsportal-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/schemeza/smsportal-laravel.svg?style=flat-square)](https://packagist.org/packages/schemeza/smsportal-laravel)

Third party package created to consume the SMSPortal RESTful API to send SMS's to phone numbers.

## Installation

You can install the package via composer:

```bash
composer require schemeza/smsportal-laravel
```

Set these `.env` variables:
```dotenv
SMSPORTAL_BASE_URL=https://rest.smsportal.com/v1
SMSPORTAL_CLIENT_ID=
SMSPORTAL_SECRET=
```

You can find your client id & secret in your [SMSPortal control panel](https://cp.smsportal.com/app/#/login).

## Usage

``` php
SMSPortal::sendMessage('0112223333', 'Hello world!');
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jaybeezorr@gmail.com instead of using the issue tracker.

## Credits

- [Jadon Brown](https://github.com/schemeza)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
