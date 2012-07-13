<?php
/**
 * @category    Mamoc
 * @package     Mamoc_Payment
 * @copyright   Copyright (c) 2012 MaMoC BV (http://www.mamoc.net)
 */

class Mamoc_Payment_Model_System_Invoice_Capture {
    protected $_options;

    public function toOptionArray() {
        if (!$this->_options) {
            $this->_options = array();
			$this->_options[] = array('value'=>'online','label'=>Mage::helper('sales')->__('Capture Online'));
			$this->_options[] = array('value'=>'offline','label'=>Mage::helper('sales')->__('Capture Offline'));
			$this->_options[] = array('value'=>'not_capture','label'=>Mage::helper('sales')->__('Not Capture'));
        }
        return $this->_options;
    }
}
?>