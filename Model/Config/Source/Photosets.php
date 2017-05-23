<?php
/*
 * Custom source for enabling/disabling photosets
 *
 * @author Hayes Marketing
 * @copyright Copyright (c) 2017 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
*/

namespace HayesMarketing\Gallery\Model\Config\Source;
use HayesMarketing\Gallery\Helper\Flickr;
class Photosets implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Photosets constructor.
     * @param Flickr $helper
     */
    public function __construct(Flickr $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $data = $this->helper->getPhotosetList();
        return $data;
    }
}