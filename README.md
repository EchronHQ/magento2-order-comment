# Magento2 Order Comment #

[![Latest Stable Version](https://img.shields.io/packagist/v/echron/magento2-module-order-comment.svg)](https://packagist.org/packages/echron/magento2-module-order-comment)

Allows customers to add a comment to their order during checkout. The comment is saved with the order and visible in
the admin and optionally in the customer's order history.

## Requirements ##

- PHP 8.0 or higher
- Magento 2.4 or higher

## Installation ##

```sh
composer require echron/magento2-module-order-comment
php bin/magento module:enable Echron_OrderComment
php bin/magento setup:upgrade
```

## Configuration ##

Go to **Stores > Configuration > Echron Extensions > Checkout Order Comment**.

| Setting                          | Description                                                       |
|----------------------------------|-------------------------------------------------------------------|
| Show comment in customer account | Displays the comment on the order detail page in "My Account"     |
| Field label                      | The label shown above the comment field                           |
| Field placeholder                | Placeholder text inside the comment field                         |
| Lines                            | Number of lines (1 renders a text input, more renders a textarea) |
| Max length                       | Maximum number of characters allowed                              |

## License ##

Licensed under [OSL-3.0](https://opensource.org/licenses/OSL-3.0)
and [AFL-3.0](https://opensource.org/licenses/AFL-3.0).
