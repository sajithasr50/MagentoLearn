<?php
namespace DollsKill\CustomerBlackList\Block\Adminhtml\CustomerBlackList\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Reset extends Generic implements ButtonProviderInterface {
	/**
	 * Get button attributes
	 *
	 * @return array
	 */
	public function getButtonData() {
		return [
			'label' => __('Reset'),
			'class' => 'reset',
			'on_click' => 'location.reload();',
			'sort_order' => 30,
		];
	}
}
