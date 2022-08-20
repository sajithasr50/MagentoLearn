<?php
namespace DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList;

use DollsKill\CustomerBlackList\Model\CustomerBlacklistFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;

/**
 * Class Delete
 *
 * @package DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList\Delete
 */
class Delete extends Action {

	/**
	 * @return \DollsKill\CustomerBlackList\Model\CustomerBlacklistFactory
	 */
	protected $customerBlackListFactory;

	/**
	 * Constructor
	 *
	 * @param Context $context
	 * @param CustomerBlacklistFactory $customerBlackListFactory
	 */
	public function __construct(
		Context $context,
		CustomerBlacklistFactory $customerBlackListFactory
	) {
		parent::__construct($context);
		$this->customerBlackListFactory = $customerBlackListFactory;
	}
	/**
	 * Delete action
	 *
	 * @return ResponseInterface|Redirect|ResultInterface
	 */
	public function execute() {
		$id = $this->getRequest()->getParam('id');
		try {
			$model = $this->customerBlackListFactory->create();
			$model->load($id);
			$model->delete();
			$this->messageManager->addSuccessMessage(__('Black Listed Email was successfully deleted'));
		} catch (\Exception $e) {
			$this->messageManager->addError($e->getMessage());
		}
		$this->_redirect('*/*/index');
	}
}
