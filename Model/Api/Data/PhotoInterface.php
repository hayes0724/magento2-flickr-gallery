<?php

/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2017 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
 */

namespace HayesMarketing\Gallery\Model\Api\Data;

interface PhotoInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID            = 'id';
    const ALBUM_URL     = 'album_url';
    const PHOTO_ID      = 'photo_id';
    const PHOTO_URL     = 'photo_url';
    const TITLE         = 'title';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const TAGS          = 'tags';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Photo ID
     *
     * @return int|null
     */
    public function getPhotoId();

    /**
     * Get Album Url
     *
     * @return string|null
     */
    public function getAlbumUrl();

    /**
     * Get Photo Url
     *
     * @return int|null
     */
    public function getPhotoUrl();

    /**
     * Get Photo Title
     *
     * @return int|null
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
     * Get photo tags
     *
     * @return string|null
     */
    public function getTags();

    /**
     * Set ID
     *
     * @param int $id
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setId($id);

    /**
     * Set Photo ID
     *
     * @param int $id
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setPhotoId($photo_id);

    /**
     * Set Album URL
     *
     * @param string $album_url
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */

    public function setAlbumUrl($album_url);

    /**
     * Set Photo URL
     *
     * @param string $photo_url
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */

    public function setPhotoUrl($photo_url);

    /**
     * Set title
     *
     * @param string $title
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */

    public function setTitle($title);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */

    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set photo tags
     *
     * @param string $tags
     * @return HayesMarketing\Gallery\Model\Api\Data\PhotoInterface
     */
    public function setTags($tags);

}

