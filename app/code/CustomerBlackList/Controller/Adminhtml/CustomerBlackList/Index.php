<?php
namespace DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList\Index
 */
class Index extends Action {
	const MENU_ID = 'DollsKill_CustomerBlackList::customerblacklist_list';

	/**
	 * @return \Magento\Framework\View\Result\Page
	 */
	protected $resultPageFactory;

	/**
	 * Constructor
	 *
	 * @param Context $context
	 * @param PageFactory $resultPageFactory
	 */
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory) {
		$this->resultPageFactory = $resultPageFactory;
		parent::__construct($context);
	}
	/**
	 * Index action
	 *
	 * @return ResultInterface
	 */
	public function execute() {
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu(static::MENU_ID);
		$resultPage->getConfig()->getTitle()->prepend(__("Black Listed Email Manager"));
		return $resultPage;
	}
}
