<?php 
namespace Modulelog\VendorEvents\Model\ResourceModel;
class DataExample extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
 public function _construct(){
 $this->_init("customer_log_login","id");
 }
}
 ?>