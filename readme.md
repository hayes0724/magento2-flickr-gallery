# Magento 2 Flickr Gallery
Magento 2 Flickr gallery is an easy to use extension that will allow you to connect any Flickr gallery to your Magento store. 

## Features
+ Get all photosets available with Flickr username and display in admin
+ Choose which photosets you would like displayed
+ Customizable photoset page to showing enabled photosets (yoursite.com/gallery)
+ SEO friendly URL's (yoursite.com/gallery/my-photoset-name)


## How to install
```bash
cd magento-directory/app/code
git clone git@github.com:hayes0724/magento2-flickr-gallery.git HayesMarketing/Gallery
php magento-directory/bin/magento setup:upgrade 
```

## How To Use
1. Add Flickr API key into Stores->Configuration->Hayes Marketing Gallery->API Key
2. Add Flickr User ID
3. Save after page refresh you will see photosets available
4. Select photosets to enable and save
5. Go to yoursite.com/gallery to view
