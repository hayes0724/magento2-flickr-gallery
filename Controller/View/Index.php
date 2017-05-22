<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Shows gallery based on ID
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        // We can add our own custom page handles for layout easily.
        $resultPage->addHandle('gallery_set_view');

        // Magento is event driven after all, lets remember to dispatch our own, to help people
        // who might want to add additional functionality, or filter the posts somehow!
        //$this->_eventManager->dispatch(
        //    'hayesmarketing_blog_post_render',
        //    ['post' => $this->_post, 'controller_action' => $action]
        //);

        return $resultPage;
    }
}