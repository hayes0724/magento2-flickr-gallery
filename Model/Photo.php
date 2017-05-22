<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2017 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Model;

use HayesMarketing\Gallery\Model\Api\Data\PhotoInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Photo extends \Magento\Framework\Model\AbstractModel implements PhotoInterface, IdentityInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'gallery_photo';

    /**
     * @var string
     */
    protected $_cacheTag = 'gallery_photo';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'gallery_photo';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('HayesMarketing\Gallery\Model\ResourceModel\Photo');
    }


    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get Photo ID
     *
     * @return int|null
     */
    public function getPhotoId()
    {
        return $this->getData(self::PHOTO_ID);
    }

    /**
     * Get Album URL
     *
     * @return string|null
     */
    public function getAlbumUrl()
    {
        return $this->getData(self::ALBUM_URL);
    }

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->getData(self::PHOTO_URL);
    }

    /**
     * Get Photo tile
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }
    

    /**
     * Set ID
     *
     * @param int $id
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set Photo ID
     *
     * @param int $id
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setPhotoId($photo_id)
    {
        return $this->setData(self::PHOTO_ID, $photo_id);
    }

    /**
     * Set Album URL
     *
     * @param string $album_url
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setAlbumUrl($album_url)
    {
        return $this->setData(self::ALBUM_URL, $album_url);
    }


    /**
     * Set Photo URL
     *
     * @param string $photo_url
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setPhotoUrl($photo_url)
    {
        return $this->setData(self::PHOTO_URL, $photo_url);
    }

    /**
     * @param string $title
     * @return mixed
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }
    
}