<?php
/**
 * CODNITIVE
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE_EULA.html.
 * It is also available through the world-wide-web at this URL:
 * http://www.codnitive.com/en/terms-of-service-softwares/
 * http://www.codnitive.com/fa/terms-of-service-softwares/
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future.
 *
 * @category   Codnitive
 * @package    Codnitive_FreeShipping
 * @author     Hassan Barza <support@codnitive.com>
 * @copyright  Copyright (c) 2012 CODNITIVE Co. (http://www.codnitive.com)
 * @license    http://www.codnitive.com/en/terms-of-service-softwares/ End User License Agreement (EULA 1.0)
 */


/**
 * Free shipping model
 *
 * @category   Codnitive
 * @package    Codnitive_FreeShipping
 * @author     Hassan Barza <support@codnitive.com>
 */
class Codnitive_FreeShipping_Model_Shipping_Carrier_Freeshipping extends Mage_Shipping_Model_Carrier_Freeshipping
{
    
    /**
     * Processing additional validation to check is carrier applicable.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Carrier_Abstract|Mage_Shipping_Model_Rate_Result_Error|boolean
     */
    public function proccessAdditionalValidation(Mage_Shipping_Model_Rate_Request $request)
    {
        $config = Mage::getModel('freeshipping/config');
        if ($config->isActive()) {
            $selectedGroups = $config->getCustomerGroupsIds(true);
            $customerGroup  = Mage::helper('customer')->getCustomer()->getGroupId();
            
            if (in_array($customerGroup, $selectedGroups)) {
                return parent::proccessAdditionalValidation($request);
            }
            return false;
        }
        
        return parent::proccessAdditionalValidation($request);
    }

}
