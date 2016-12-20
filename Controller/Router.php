<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketingfirm.com)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }
    /**
     * Validate and Match photoset and modify request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $url = $request->getPathInfo();
        $gallery_id = $this->trimUrl($url);
        $request->setModuleName('gallery')
            ->setControllerName('view')
            ->setActionName('index')
            ->setParam('gallery_id', $gallery_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }

    /**
     * @param $haystack
     * @return mixed
     */
    public function trimUrl ($haystack)
    {
        $needle = '/gallery/';
        $replace = '';
        $pos = strpos($haystack, $needle);
        $newstring = "";
        if ($pos !== false)
        {
            $newstring = substr_replace($haystack, $replace, $pos, strlen($needle));
        }
        return $newstring;
    }
}