# ML DeveloperTest

    ``ml/module-developertest``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
products to be allowed limited by country from manageable from admin on product level

1. At a product level, allow the admin to BLOCK the product from being ordered from one or more countries.
2. Use ‘IP 2 Country GeoIP’ (https://ip2country.info) to obtain the country for the current customer. So, I have used this api to get current location to ipapi (https://ipapi.com/login)
3. When a product is added to the cart, perform a check to make sure it can be ordered.
4. If the customer cannot order the product, show a message to the customer using the standard built-in
   notices functionality that reads:
   “I’m sorry, this product cannot be ordered from COUNTRY_NAME”.
5. The above message should be editable in the module configuration in the admin.
6. We need to be able to enable/disable the overall functionality in the configuration in the admin.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/ML`
 - Enable the module by running `php bin/magento module:enable ML_DeveloperTest`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require ml/module-developertest`
 - enable the module by running `php bin/magento module:enable ML_DeveloperTest`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - Enabled (developer-test/general/enabled)

## Attributes

 - Product - Restricted Countries (restrict_countries)

