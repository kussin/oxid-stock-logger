# Kussin | OXID 6 Stock Logger

This module takes a snapshot of product stock and saves it to a csv file in `/path/to/oxid/source/log/stock/`.

## Requirement

1. OXID eShop Version CE/PE/EE v6.x or newer
2. PHP 7.4 or newer

## Installation

1. Download the latest release from Github
2. Unzip the archive
3. Copy the content of the folder `src` to the root of your OXID eShop installation
4. Install cronjob for `php /path/to/oxid/source/bin/stock-logger.php`

**RECOMMENDATION:** Run the cronjob max. every hour and keep track on the file size.

## Support

Kussin | eCommerce und Online-Marketing GmbH<br>
Fahltskamp 3<br>
25462 Rellingen<br>
Germany

Fon: +49 (4101) 85868 - 0<br>
Email: info@kussin.de

## Licence

[End-User Software License Agreement](LICENSE)

## Copyright

(c) 2006-2022 Kussin | eCommerce und Online-Marketing GmbH