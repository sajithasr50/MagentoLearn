<?php 
declare(strict_types=1);

/**
 * Patch to create Customer Attribute
 *
 * Creates otp login custom attribute
 *
 * @author Shibin VR
 * @package Litmus7_OTPLogin
 */

namespace Litmus7\OTPLogin\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class OtpCreatedAttribute
 */
class OtpCreatedAttribute implements DataPatchInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * OtprAttribute constructor.
     *
     * @param Config              $eavConfig
     * @param EavSetupFactory     $eavSetupFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer', 'login_otp_created', [
            'type' => 'datetime',
            'label' => 'Otp Created',
            'input' => 'date',
            'required' => false,
            'visible' => false,
            'user_defined' => false,
            'position' =>999,
            'system' => 0,
            'group' => 'General',
            'global' => true,
            'unique' => false,
        ]);
        $customAttribute = $this->eavConfig->getAttribute('customer', 'login_otp_created');
             $customAttribute->setData(
            'used_in_forms',
            []
        );
        $customAttribute->save();

    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}