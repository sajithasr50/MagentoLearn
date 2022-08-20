<?php
namespace DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList;

use Magento\Framework\App\Action\Action;

/**
 * Class Add
 *
 * @package DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList\Add
 */
class Add extends Action {

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
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory) {
		$this->resultPageFactory = $resultPageFactory;
		parent::__construct($context);
	}
	/**
	 * Add action
	 *
	 * @return ResultInterface
	 */
	public function execute() {
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu(self::MENU_ID);
		$resultPage->getConfig()->getTitle()->prepend(__("Add Black Listed Email"));
		return $resultPage;
	}
}
