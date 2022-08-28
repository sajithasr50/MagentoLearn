<?php		
		
namespace Litmus7\OTPLogin\Model;

class OTPAttribute implements \Litmus7\OTPLogin\Api\Data\OtpAttributeInterface		
{
    /**		
     * {@inheritdoc}		
     */
    public function getValue()		
    {
        return $this->getData(self::VALUE);	
    }
    /**		
     * {@inheritdoc}		
     */
    public function setValue($value)		
    {
        return $this->setData(self::VALUE, $value);
    }		
}