<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketing.io)
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
     * Gets the currently selected photosets from configuration
     * @return array
     */
    public function getActivePhotosets()
    {
        $sets = $this->scopeConfig->getValue('gallery_settings/albums/photosets', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $arr = explode(",", $sets);
        return $arr;
    }

    /**
     * @return integer
     */
    public function getMaxSize()
    {
        $maxSize = $this->scopeConfig->getValue('gallery_settings/albums/max_size', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $maxSize;
    }

    /**
     * Gets last date/time the gallery was synced
     * @return string
     */
    public function getLastUpdateTime()
    {
        $updateTime = $this->scopeConfig->getValue('gallery_settings/albums/last_update', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $updateTime;
    }


                                            /*Helper Functions*/

    /**
     * Gets all photoset ID's from flickr, format for mangento admin
     * @return array
     */
    public function getPhotosetList() {
        $photosets = $this->photosets_getList();
        $data = [];
        if ($photosets['stat'] == 'ok')
        {
            foreach ($photosets['photosets']['photoset'] as $photoset)
            {
                $data[] = ['value' => $photoset['id'],'label' => $photoset['title']['_content']];
            }
        }
        return $data;
    }


    /**
     * Gets all photoset ID's from flickr
     * @return array
     */
    public function getAllPhotosets()
    {
        $photosets = $this->photosets_getList();
        $data = [];
        if ($photosets['stat'] == 'ok')
        {
            foreach ($photosets['photosets']['photoset'] as $photoset)
            {
                $data[] = $photoset['id'];
            }
        }
        return $data;
    }

    /**
     * Gets photoset ID from system config, connects to Flickr API, returns photoset info array
     * @return array
     */
    public function getAllPhotosetInfo()
    {
        $arr = $this->getAllPhotosets();
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
            $cleanUrl = $this->cleanUrl($title);
            $set = ['id' => $photoID, 'title' => $title, 'url' => 'abc456', 'set' => $setID, 'clean' => $cleanUrl];
            $photos[] = $set;
        }
        return $photos;
    }
    /**
     * Gets photoset ID from system config, connects to Flickr API, returns photoset info array
     * @return array
     */
    //
    public function getPhotosetInfo() //@TODO: Rename getActivePhotosetInfo()
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
            $url = $this->getPhotoUrl($photoID);
            $cleanUrl = $this->cleanUrl($title);
            $set = ['id' => $photoID, 'title' => $title, 'url' => $url, 'set' => $setID, 'clean' => $cleanUrl];
            $photos[] = $set;
        }
        return $photos;
    }

    /**
     * Input photo ID, connects to Flickr API, returns photo url
     * @param int $photoID
     * @param int $size
     * @return mixed
     */
    public function getPhotoUrl($photoID)
    {
        $size = $this->getMaxSize();
        $sizes = $this->photos_getSizes($photoID);
        $maxSize = count($sizes) - 1;
        if ($size > $maxSize)
        {
            $size = $maxSize;
        }
        $url = $sizes[$size]['source'];
        return $url;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function cleanUrl($url)
    {
        $lower = strtolower($url);
        $dashOnly = str_replace([" ", "_"], "-", $lower);
        $clean = str_replace(["(",")"], "", $dashOnly);
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

                                            /*Flickr API calls*/

    /*
     * Flickr methods use a matching function call
     * flickr.photosets.getList => photosets_getList()
    */

    /**
     * @return mixed
     */
    private function flickrEcho()
    {
        $response = $this->post('flickr.test.echo');
        return $response;
    }

                                                /* Photoset Methods */
    /**
     * @return mixed
     */
    private function photosets_getList()
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
    private function photosets_getInfo($photosetID)
    {
        $userID = $this->getUserID();
        $param = ['user_id' => $userID, 'photoset_id' => $photosetID];
        $response = $this->post('flickr.photosets.getInfo', $param);
        return $response;
    }

    /**6
     * @return mixed
     */
    private function photosets_getPhotos($photosetID)
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
    private function photos_getSizes($photoID)
    {
        $param = ['photo_id' => $photoID];
        $response = $this->post('flickr.photos.getSizes', $param);
        return $response['sizes']['size'];
    }


                                        /* Tag Methods */

    /**
     * Get the tag list for a given photo ID.
     * @param $photoID
     * @return mixed
     */
    private function tags_getListPhoto($photoID) {
        $param = ['photo_id' => $photoID];
        $response = $this->post('flickr.tags.getListPhoto', $param);
        return $response['photo']['tags'];
    }

}

