<?php
/**
 * @author Hayes Marketing
 * @copyright Copyright (c) 2016 Hayes Marketing (http://www.hayesmarketing.io)
 * @package HayesMarketing_Gallery
 */
namespace HayesMarketing\Gallery\Controller\Index;


class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
    * Constructor
    *
    * @param \Magento\Framework\App\Action\Context  $context
    * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
    */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
        )
        {
            $this->resultPageFactory = $resultPageFactory;
            parent::__construct($context);
        }

    /**
    * Execute view action
    *
    * @return \Magento\Framework\Controller\ResultInterface
    */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}