# Mage2 Module Y2B EmailNotification

    ``y2b/module-emailnotification``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
EmailNotification Module.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Y2B`
 - Enable the module by running `php bin/magento module:enable Y2B_EmailNotification`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require y2b/module-emailnotification`
 - enable the module by running `php bin/magento module:enable Y2B_EmailNotification`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - You can manage module configuration from Admin > Stores > Settings > Configurations:
 - "Status" : With this setting you can enable/disable module.
 - "Enable for customer registration" : With this setting you can check keywords when customer registration.
 - "Enable for newsletter registration" : With this setting you can check keywords when newsletter registration.
 
## Screenshot

![Alt text](https://raw.githubusercontent.com/bbhajgotar/magento-2-stopspamregistration/main/docs/Screenshot-1.png "Optional title")

