<?php
/**
 * @category    Mamoc
 * @package     Mamoc_Payment
 * @copyright   Copyright (c) 2012 MaMoC BV (http://www.mamoc.net)
 */

class Mamoc_Payment_Model_Observer {

	public function autoCreateInvoice($observer){
		$event	= $observer->getEvent();
		$order = $event->getOrder();

		$createInvoice = Mage::getStoreConfigFlag('payment/'.$order->getPayment()->getMethod().'/create_invoice');

        if($order->getId() && $order->canInvoice() && $createInvoice){

			$capture_case = Mage::getStoreConfig('payment/'.$order->getPayment()->getMethod().'/invoice_status');

			$invoice = $order->prepareInvoice();
			$invoice->setRequestedCaptureCase($capture_case);
			$invoice->register();

			Mage::getModel('core/resource_transaction')
				->addObject($invoice)
				->addObject($invoice->getOrder())
				->save();

			$order->addStatusToHistory($order->getStatus(), Mage::helper('mmc_payment')->__('Invoice created!'));
        }
	}
}
?>
