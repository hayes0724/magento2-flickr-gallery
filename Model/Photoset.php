<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2017 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Model;

use HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Photoset  extends \Magento\Framework\Model\AbstractModel implements PhotosetInterface, IdentityInterface
{

    /**#@+
     * Album's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**#@-*/

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'gallery_photoset';

    /**
     * @var string
     */
    protected $_cacheTag = 'gallery_photoset';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'gallery_photoset';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('HayesMarketing\Gallery\Model\ResourceModel\Photoset');
    }

    /**
     * Check if post url key exists
     * return post id if post exists
     *
     * @param string $url_key
     * @return int
     */
    public function checkUrlKey($url_key)
    {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    /**
     * Prepare photoset's statuses.
     * Available event gallery_photoset_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
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
    public function getPhotoUrl()
    {
        return $this->getData(self::PHOTO_URL);
    }

    /**
     * Get Album ID
     *
     * @return int|null
     */
    public function getAlbumId()
    {
        return $this->getData(self::ALBUM_ID);
    }

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey()
    {
        return $this->getData(self::URL_KEY);
    }

    /**
     * Get title
     *
     * @return string|null
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
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set Photo URL
     *
     * @param string $photo_urll
     * @return \HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setPhotoUrl($photo_url)
    {
        return $this->setData(self::PHOTO_URL, $photo_url);
    }

    /**
     * Set Album ID
     *
     * @param int $id
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setAlbumId($id)
    {
        return $this->setData(self::ALBUM_ID, $id);
    }


    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setUrlKey($url_key)
    {
        return $this->setData(self::URL_KEY, $url_key);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    /**
     * Set is active
     *
     * @param int|bool $is_active
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

}