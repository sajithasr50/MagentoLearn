<?php
namespace Litmus7\OTPLogin\Api\Data;

interface OtpAttributeInterface		
{
    const VALUE = 'value';
    /**		
     * Return value.		
     *		
     * @return string|null 		
     */
    public function getValue();

    /**		
     * Set value.		
     *		
     * @param string|null $value		
     * @return $this		
     */
    public function setValue($value);
}		