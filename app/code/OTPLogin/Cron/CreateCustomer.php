<?php
declare(strict_types=1);

namespace Litmus7\OTPLogin\Cron;
 
class CreateCustomer
{

    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->_logger = $logger;
    } 
    public function execute(){
        $this->_logger->info('Create customer cron is execute');
    }
}