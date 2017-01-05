<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2017 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */

namespace HayesMarketing\Gallery\Model\Api\Data;

interface PhotosetInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */

    const ID            = 'id';
    const SET_ID        = 'set_id';
    const PHOTO_URL     = 'photo_url';
    const URL_KEY       = 'url_key';
    const TITLE         = 'title';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Photo URL
     *
     * @return string|null
     */
    public function getPhotoUrl();

    /**
     * Get Album Key
     *
     * @return int|null
     */
    public function getAlbumId();

    /**
     * Get URL Key
     *
     * @return int|null
     */
    public function getUrlKey();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return PhotosetInterface
     */
    public function setId($id);

    /**
     * Set Photo URL
     *
     * @param string $photo_url
     * @return PhotosetInterface
     */
    public function setPhotoUrl($photo_url);

    /**
     * Set Album ID
     *
     * @param string $album_id
     * @return PhotosetInterface
     */

    public function setAlbumId($album_id);

    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return PhotosetInterface
     */

    public function setUrlKey($url_key);


    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PhotosetInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return PhotosetInterface
     */
    public function setUpdateTime($updateTime);

}