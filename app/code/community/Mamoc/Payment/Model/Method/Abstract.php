<?php
/**
 * @category    Mamoc
 * @package     Mamoc_Payment
 * @copyright   Copyright (c) 2012 MaMoC BV (http://www.mamoc.net)
 */

class Mamoc_Payment_Model_Method_Abstract extends Mage_Payment_Model_Method_Abstract {

	public function isAvailable($quote = null) {
		$allowed_groups		= explode(',',Mage::getStoreConfig('payment/'.$this->_code.'/allow_group'));
		$min_order_amount	= Mage::getStoreConfig('payment/'.$this->_code.'/min_order_amount');
		if(!is_numeric($min_order_amount)){
			$min_order_amount = 0;
		}
		$max_order_amount	= Mage::getStoreConfig('payment/'.$this->_code.'/max_order_amount');
		if(!is_numeric($max_order_amount)){
			$max_order_amount = 0;
		}


		if( $min_order_amount>0 && (Mage::app()->getStore()->roundPrice($quote->getGrandTotal()) < Mage::app()->getStore()->roundPrice($min_order_amount)) ) {
			return false;
		}

		if($max_order_amoun>0 && (Mage::app()->getStore()->roundPrice($quote->getGrandTotal()) >= Mage::app()->getStore()->roundPrice($max_order_amount)) ) {
			return false;
		}

		if(!in_array($quote->getCustomerGroupId(),$allowed_groups)) {
			return false;
		}

        return parent::isAvailable($quote);
    }
}
?>
