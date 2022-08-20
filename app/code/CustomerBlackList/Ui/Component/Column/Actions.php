<?php
namespace DollsKill\CustomerBlackList\Ui\Component\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column {

	const URL_PATH_EDIT = 'customerblacklist/customerblacklist/edit';
	const URL_PATH_DELETE = 'customerblacklist/customerblacklist/delete';
	/**
	 * @var \Magento\Framework\AuthorizationInterface
	 */
	private $authorization;

	/**
	 * URL builder
	 *
	 * @var \Magento\Framework\UrlInterface
	 */
	protected $urlBuilder;

	/**
	 * PageActions constructor.
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param \Magento\Framework\AuthorizationInterface $authorization
	 * @param array $components
	 * @param array $data
	 */
	public function __construct(ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		\Magento\Framework\AuthorizationInterface $authorization,
		UrlInterface $urlBuilder,
		array $components = [],
		array $data = []) {
		parent::__construct($context, $uiComponentFactory, $components, $data);
		$this->authorization = $authorization;
		$this->urlBuilder = $urlBuilder;
	}

	/**
	 * @param array $dataSource
	 * @return array
	 */
	public function prepareDataSource(array $dataSource) {

		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as &$item) {
				if (isset($item['id'])) {
					$item[$this->getData('name')] = [
						'edit' => [
							'href' => $this->urlBuilder->getUrl(
								static::URL_PATH_EDIT,
								[
									'id' => $item['id'],
								]
							),
							'label' => __('Edit'),
						],
						'reject' => [
							'href' => $this->urlBuilder->getUrl(
								static::URL_PATH_DELETE,
								[
									'id' => $item['id'],
								]
							),
							'label' => __('Delete'),
							'confirm' => [
								'title' => __('Delete'),
								'message' => __('Are you sure you want to Delete Black listed Email'),
							],
						],
					];
				}
			}
		}
		return $dataSource;
	}

}
