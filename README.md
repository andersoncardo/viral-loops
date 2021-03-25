# Mage2 Module Cardoso ViralLoops

    ``Cardoso/module-viralloops``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
The Magento module for integration with viral-loops.com is a plugin that enables online store owners to create referral marketing campaigns focused on incentivizing customers to share products with their friends. The module provides campaign rule definition, referral tracking, and detailed reporting on campaign performance to increase product visibility and drive sales.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Cardoso`
 - Enable the module by running `php bin/magento module:enable Cardoso_ViralLoops`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require Cardoso/module-viralloops`
 - enable the module by running `php bin/magento module:enable Cardoso_ViralLoops`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration




## Specifications

 - Block
	- Script\Assign > script/assign.phtml

 - Controller
	- frontend > rewarding/referal/index


## Attributes

 - Customer - has_rewarding (has_rewarding)

 - Customer - referral Code (referral_code)

