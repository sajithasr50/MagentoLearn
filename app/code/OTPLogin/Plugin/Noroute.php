<?php

namespace Litmus7\OTPLogin\Plugin;

class Noroute
{


	public function beforeExecute(\Magento\Cms\Controller\Noroute\Index $subject)
	{
		$title = "Before";
		$title = $title . " to ";
		echo __METHOD__ . "</br>";

		return [$title];
	}
	public function afterExecute(\Magento\Cms\Controller\Noroute\Index $subject , $result)
	{
		echo __METHOD__ . "</br>";

		return $result;
	}
	public function aroundExecute(\Magento\Cms\Controller\Noroute\Index $subject, callable $proceed)
	{

		echo __METHOD__ . " - Before proceed() </br>";
		 $result = $proceed();
		echo __METHOD__ . " - After proceed() </br>";

		return $result;
	}

}