<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Block;

use HayesMarketing\Gallery\Model\Api\Data\PhotosetInterface;
use HayesMarketing\Gallery\Model\ResourceModel\Photoset\Collection as PhotosetCollection;

class Photoset extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    protected $_photosetCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \HayesMarketing\Gallery\Model\ResourceModel\Photoset\CollectionFactory $photosetCollectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_photosetCollectionFactory = $photosetCollectionFactory;
    }


    /**
     * @return \HayesMarketing\Gallery\Model\ResourceModel\Photoset\Collection
     */
    public function getPhotosets()
    {
        if (!$this->hasData('photosets')) {
            $photosets = $this->_photosetCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->addOrder(
                    PhotosetInterface::CREATION_TIME,
                    PhotosetCollection::SORT_ORDER_DESC
                );
            $this->setData('photosets', $photosets);
        }
        return $this->getData('photosets');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\HayesMarketing\Gallery\Model\Photoset::CACHE_TAG . '_' . 'list'];
    }


}