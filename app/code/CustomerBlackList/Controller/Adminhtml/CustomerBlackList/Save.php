<?php
namespace DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList;

use DollsKill\CustomerBlackList\Model\CustomerBlacklistFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;

/**
 * Class Save
 *
 * @package DollsKill\CustomerBlackList\Controller\Adminhtml\CustomerBlackList\Save
 */
class Save extends Action {

	/**
	 * @return \DollsKill\CustomerBlackList\Model\CustomerBlackListFactory
	 */
	protected $customerBlackListFactory;

	/**
	 * Constructor
	 *
	 * @param Context $context
	 * @param CustomerBlackListFactory $customerBlackListFactory
	 */
	public function __construct(
		Context $context,
		CustomerBlackListFactory $customerBlackListFactory
	) {
		parent::__construct($context);
		$this->customerBlackListFactory = $customerBlackListFactory;
	}
	/**
	 * Save action
	 *
	 * @return ResponseInterface|Redirect|ResultInterface
	 */
	public function execute() {
		try {
			$id = $this->getRequest()->getParam('id');
			$data = $this->getRequest()->getParams();
			$model = $this->customerBlackListFactory->create();
			$message = __('Black Listed Email was successfully saved');
			if ($id) {
				$model->load($id);
				$message = __('Black Listed Email was successfully updated');
			}
			$model->setData($data);
			$model->save();
			$this->messageManager->addSuccessMessage($message);
		} catch (\Exception $e) {
			$this->messageManager->addErrorMessage(__($e->getMessage()));
		}
		$this->_redirect('*/*/index');
	}
}
