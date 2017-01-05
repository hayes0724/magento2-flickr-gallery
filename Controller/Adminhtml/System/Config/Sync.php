<?php

namespace HayesMarketing\Gallery\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use HayesMarketing\Gallery\Helper\Flickr;

class Sync extends Action
{

    protected $resultJsonFactory;

    /**
     * @var Data
     */
    protected $helper;

    protected $photosetFactory;

    protected $photoFactory;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param Flickr $helper
     * @param \HayesMarketing\Gallery\Model\PhotosetFactory $photosetFactory
     * @param \HayesMarketing\Gallery\Model\PhotoFactory $photoFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        \HayesMarketing\Gallery\Helper\Flickr $helper,
        \HayesMarketing\Gallery\Model\PhotosetFactory $photosetFactory,
        \HayesMarketing\Gallery\Model\PhotoFactory $photoFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->helper = $helper;
        $this->photosetFactory = $photosetFactory;
        $this->photoFactory = $photoFactory;
        parent::__construct($context);
    }

    /**
     * Syncs Photosets
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $this->deletePhotosets();
        $this->deletePhotos();
        $sets = $this->setPhotosets();
        foreach ($sets as $set)
        {
            $id = $set['set'];
            $clean = $set['clean'];
            $photos = $this->getPhotos($id);
            $this->setPhotos($photos, $clean);
        }

        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultJsonFactory->create();
        $result->setData(['success' => true, 'photosets_added' => 'unknown']);
        return $result;
    }

    /**
     * Deletes all photosets from database before syncing and resets auto increment id to 1
     *
     */
    public function deletePhotosets()
    {
        $photoSets = $this->photosetFactory->create()->getCollection();
        $resource = $photoSets->getResource();
        $connection = $resource->getConnection();
        $tableName = $resource->getMainTable();
        $connection->truncateTable($tableName);
        $sql = "ALTER TABLE " . $tableName ." AUTO_INCREMENT = 1 ";
        $connection->query($sql);
    }

    /**
     * Deletes all photos from database before syncing and resets auto increment id to 1
     *
     */
    public function deletePhotos()
    {
        $photoSets = $this->photoFactory->create()->getCollection();
        $resource = $photoSets->getResource();
        $connection = $resource->getConnection();
        $tableName = $resource->getMainTable();
        $connection->truncateTable($tableName);
        $sql = "ALTER TABLE " . $tableName ." AUTO_INCREMENT = 1 ";
        $connection->query($sql);
    }

    /**
     * Sets photoset data in table photosets from API call results
     * @return array $sets
     */
    public function setPhotosets()
    {
        $sets = $this->helper->getPhotosetInfo();

        foreach ($sets as $set)
        {
            $photoSets = $this->photosetFactory->create();
            $photoSets->setData('photo_url', $set['url']);
            $photoSets->setData('album_id', $set['set']);
            $photoSets->setData('title', $set['title']);
            $photoSets->setData('url_key', $set['clean']);
            $photoSets->setData('is_active', 1);
            $photoSets->save();
        }
        return $sets;
    }

    /**
     * Sets photos data in table photos from API call results
     * @param $photos array
     * @param $photosetId integer
     * @return array $photos
     */
    public function setPhotos($photos, $clean)
    {
        foreach ($photos as $photo)
        {
            $photoSets = $this->photoFactory->create();
            $photoSets->setData('photo_id', $photo['id']);
            $photoSets->setData('album_url', $clean);
            $photoSets->setData('title', $photo['title']);
            $photoSets->setData('photo_url', $photo['url']);
            $photoSets->save();
        }
        return $photos;
    }

    /**
     * @param $photosetId integer
     * @return array $photos
     */
    public function getPhotos($id)
    {
            $photoSet = $this->helper->photosets_getPhotos($id)['photoset'];
            $photos = [];
            foreach ($photoSet['photo'] as $photo)
            {
                $id = $photo['id'];
                $title = $photo['title'];
                $url = $this->helper->getPhotoUrl($id);
                $set = ['id' => $id, 'title' => $title, 'url' => $url];
                $photos[] = $set;
            }
            return $photos;
    }


}
?>