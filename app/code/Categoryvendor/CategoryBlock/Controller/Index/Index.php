<?php
namespace Categoryvendor\CategoryBlock\Controller\Index;
use \Magento\Framework\App\Action\Action;

class Index extends Action
{

    public function __construct(
        \Magento\Framework\App\Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        echo "Hello World";
        die();
    }
}