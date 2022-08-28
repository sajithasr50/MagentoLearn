<?php

namespace Modulelog\VendorLogs\Plugin;

use Magento\Backend\App\Action\Context;
use Modulelog\VendorLogs\Model\DataExampleFactory;


class LoginPosts 
{
   
    public function __construct(DataExampleFactory $dataExampleFactory)
    {
		$this->dataExampleFactory = $dataExampleFactory;
    }

	public function afterExecute (\Magento\Customer\Controller\Account\LoginPost $subject, $result)
	{

	
		$data 	= $subject->getRequest()->getParams();
		$email 	=  $data['login']['username'];
		$time 	= time();
		$model 	= $this->dataExampleFactory->create();
		$model->addData([
			"email" =>$email,
			"created_at" => $time
			]);
        $model->save();

		return $result;
	}
}
