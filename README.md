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
// To send a message to a single phone number
SMSPortal::sendMessage('0112223333', 'Hello world!');
```

``` php
// To send a message to a multiple phone numbers (without text replacements)

$numbers = [
    "0000000000",
    "00000000001",
];

SMSPortal::sendMessage($numbers, 'Hello world!');
```


``` php
// To send a message to a multiple phone numbers (with text replacements)
// Replacements must be an array of array arrays with a key attribute and a value attribute
// Its up to you to determine the key, in this is its ::first_name:: but it could be {first_name}, etc.

$numbers = [
    "0000000000",
    "00000000001",
];

$replacements = [
    [
        [
            "key"   => "::first_name::",
            "value" => "John"
        ],
        [
            "key"   => "::weather::",
            "value" => "hot",
        ]
    ],
    [
        [
            "key"   => "::first_name::",
            "value" => "Alice"
        ],
        [
            "key"   => "::weather::",
            "value" => "cold",
        ]
    ],
]

SMSPortal::sendMessage($numbers, 'Hello ::first_name::, today is ::weather::!', $replacements);
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
