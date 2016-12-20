<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;

class Flickr extends AbstractHelper
{
    /**
     * Flickr constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context)
    {
        parent::__construct($context);
    }

                                        /*Get store configuration functions*/

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        $api =  $this->scopeConfig->getValue('gallery_settings/flickr/api', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $api;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        $secret = $this->scopeConfig->getValue('gallery_settings/flickr/secret', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $secret;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        $id = $this->scopeConfig->getValue('gallery_settings/flickr/id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $id;
    }

    /**
     * @return array
     */
    public function getActivePhotosets()
    {
        $sets = $this->scopeConfig->getValue('gallery_settings/albums/photosets', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $arr = explode(",", $sets);
        return $arr;
    }

                                                /*Helper Functions*/

    /**
     * Gets photoset ID from system config, connects to Flickr API, returns photoset info array
     * @return array
     */
    public function getPhotosetInfo()
    {
        $arr = $this->getActivePhotosets();
        $info = [];
        foreach ($arr as $photosetID)
        {
            $info[] = $this->photosets_getInfo($photosetID);
        }
        $photos = [];
        foreach ($info as $photoset)
        {
            $setID = $photoset['photoset']['id'];
            $photoID = $photoset['photoset']['primary'];
            $title = $photoset['photoset']['title']['_content'];
            $url = $this->getPhotoInfo($photoID, 6);
            $cleanUrl = $this->cleanUrl($title);
            $set = ['id' => $photoID, 'title' => $title, 'url' => $url, 'set' => $setID, 'clean' => $cleanUrl];
            $photos[] = $set;
        }
        return $photos;
    }

    /**
     * Input photo ID, connects to Flickr API, returns photo url
     * @param $photoID
     * @param int $size
     * @return mixed
     */
    public function getPhotoInfo($photoID, $size = 0) //TODO: rename getPhotoUrl
    {
        $sizes = $this->photos_getSizes($photoID);
        if ($size != 0)
        {
            $sizes = $sizes[$size];
        }
        $url = $sizes['source'];
        return $url;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function cleanUrl($url)
    {
        $lower = strtolower($url);
        $clean = str_replace(" ", "-", $lower);
        return $clean;
    }

    /**
     * Post handler for connecting to Flickr API
     * @param string $method
     * @return mixed
     */
    public function post($method, $options = null)
    {
        $params = array(
            'method'	=> $method,
            'api_key'	=> $this->getApiKey(),
            'format'	=> 'php_serial'
        );

        if ($options != null)
        {
            foreach ($options as $key => $value)
            {
                $params[$key] = $value;
            }
        }

        $encoded_params = array();

        foreach ($params as $k => $v){

            $encoded_params[] = urlencode($k).'='.urlencode($v);
        }

        $url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);
        $rsp = file_get_contents($url);
        $response = unserialize($rsp);

        return $response;
    }

                                            /*Flickr method calls*/

    /*
    All Flickr methods have a matching function call for example with flickr removed
    flickr.photosets.getList => photosets_getList()
    */

    /**
     * @return mixed
     */
    public function flickrEcho()
    {
        $response = $this->post('flickr.test.echo');
        return $response;
    }

                                                /* Photoset Methods */
    /**
     * @return mixed
     */
    public function photosets_getList()
    {
        $userID = $this->getUserID();
        $param = ['user_id' => $userID];
        $response = $this->post('flickr.photosets.getList', $param);
        return $response;
    }

    /**
     * @param $photosetID
     * @return mixed
     */
    public function photosets_getInfo($photosetID)
    {
        $userID = $this->getUserID();
        $param = ['user_id' => $userID, 'photoset_id' => $photosetID];
        $response = $this->post('flickr.photosets.getInfo', $param);
        return $response;
    }

    /**
     * @param $photosetID
     * @return mixed
     */
    public function photosets_getPhotos($photosetID)
    {
        $userID = $this->getUserID();
        $param = ['user_id' => $userID, 'photoset_id' => $photosetID];
        $response = $this->post('flickr.photosets.getPhotos', $param);
        return $response;
    }

                                            /* Photo Methods */

    /**
     * @param $photoID
     * @return mixed
     */
    public function photos_getSizes($photoID)
    {
        $param = ['photo_id' => $photoID];
        $response = $this->post('flickr.photos.getSizes', $param);
        return $response['sizes']['size'];
    }


}

