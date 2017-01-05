<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Block;

use HayesMarketing\Gallery\Model\ResourceModel\Photoset\Collection as PhotoCollection;
use HayesMarketing\Gallery\Model\Api\Data\PhotoInterface;

class View extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    protected $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \HayesMarketing\Gallery\Model\ResourceModel\Photo\CollectionFactory $photoCollectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_photoCollectionFactory = $photoCollectionFactory;
    }

    /**
     * @return \HayesMarketing\Gallery\Model\ResourceModel\Photo\Collection
     */
    public function getPhotos()
    {
        $url = $this->getGalleryUrl();
        if (!$this->hasData('photo')) {
            $photo = $this->_photoCollectionFactory->create()->addFilter('album_url', $url);
            $this->setData('photo', $photo);
        }
        return $this->getData('photo');
    }

    /**
     * @return integer
     */
    public function getGalleryUrl()
    {
        $gallery_url = $this->getRequest()->getParams();
        return $gallery_url['gallery_url'];
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\HayesMarketing\Gallery\Model\Photo::CACHE_TAG . '_' . 'list'];
    }
}


