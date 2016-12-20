<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Block;

class View extends \Magento\Framework\View\Element\Template
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
    public function getPhotos()
    {
        $clean = $this->getGalleryName();
        $sets = $this->_helper->getPhotosetInfo();
        $match_id = "";
        foreach ($sets as $set)
        {
            $gallery_url = $set['clean'];
            $gallery_id = $set['set'];
            if ($clean == $gallery_url)
            {
                $match_id = $gallery_id;
            }
        }
        $photoSet = $this->_helper->photosets_getPhotos($match_id)['photoset'];
        foreach ($photoSet['photo'] as $photo)
        {
            $id = $photo['id'];
            $title = $photo['title'];
            $url = $this->_helper->getPhotoInfo($id, 6);
            $set = ['id' => $id, 'title' => $title, 'url' => $url];
            $photos[] = $set;
        }
        return $photos;
    }

    /**
     * @return mixed
     */
    public function getGalleryName()
    {
        $gallery_id = $this->getRequest()->getParams();
        return $gallery_id['gallery_id'];
    }

}


