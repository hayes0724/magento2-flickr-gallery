# Magento 2 Flickr Gallery
Magento 2 Flickr gallery is an easy to use extension that will allow you to connect any Flickr gallery to your Magento store. 

## Installation
#### Install with Composer
```bash
composer require hayesmarketing/flickr-gallery
php magento-directory/bin/magento setup:upgrade 
```
#### Install with GIT
```bash
cd magento-directory/app/code
git clone git@github.com:hayes0724/magento2-flickr-gallery.git HayesMarketing/Gallery
php magento-directory/bin/magento setup:upgrade 
```

## Features
+ Store API results in database for faster loading
+ Select which size photo's to use from Flickr
+ Get all photosets available with Flickr username and display in admin
+ Choose which photosets you would like displayed
+ Customizable photoset page to showing enabled photosets (yoursite.com/gallery)
+ Customizable gallery slider page (yoursite.com/gallery/my-photoset-name)
+ SEO friendly URL's generated from photoset title 
(Ex:My-PhotoSet_Title => /my-photoset-title)

## How To Use
1. Add Flickr API key into Stores->Configuration->Hayes Marketing Gallery->API Key
2. Add Flickr User ID
3. Save after page refresh you will see photosets available
4. Select photosets to enable and save
5. Click sync to download all data from Flickr based on settings set earlier
5. Go to yoursite.com/gallery to view


