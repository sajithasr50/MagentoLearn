<?php
namespace DollsKill\CustomerBlackList\Ui\Component\DataProvider;

use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {

	protected $loadedData;

	protected $rowCollection;

	protected $request;

	protected $storeManager;

	public function __construct(
		$name,
		$primaryFieldName,
		$requestFieldName,
		\DollsKill\CustomerBlackList\Model\ResourceModel\CustomerBlackList\Collection $collection,
		\DollsKill\CustomerBlackList\Model\ResourceModel\CustomerBlackList\CollectionFactory $collectionFactory,
		\Magento\Framework\App\RequestInterface $request,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		array $meta = [],
		array $data = []
	) {
		$this->collection = $collection;
		$this->rowCollection = $collectionFactory;
		$this->request = $request;
		$this->storeManager = $storeManager;
		parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
	}
	public function getData() {
		if (isset($this->loadedData)) {
			return $this->loadedData;
		}
		$items = $this->collection->getItems();
		$this->loadedData = array();
		/** @var Customer $customer */
		foreach ($items as $customerblacklist) {
			$this->loadedData[$customerblacklist->getId()] = $customerblacklist->getData();
		}
		//exit();
		return $this->loadedData;

	}

}
