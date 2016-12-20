<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Block;

class Photoset extends \Magento\Framework\View\Element\Template
{
    protected $helper;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \HayesMarketing\Gallery\Helper\Flickr $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_helper = $helper;
    }

    /**
     * @return array
     */
    public function getActivePhotosets()
    {
        $activePhotosets = $this->_helper->getPhotosetInfo();
        return $activePhotosets;
    }

    /**
     * @return mixed
     */
    public function cleanUrl($url)
    {
        $lower = strtolower($url);
        $clean = str_replace(" ", "-", $lower);
        return $clean;
    }

    public function sanityCheck()
    {

    }

    public function _prepareLayout()
    {

    }



}