<?php
class Mamoc_Oprekening_Model_Observer {

	public function autoCreateInvoice($observer){
		$event	= $observer->getEvent();
		$order = $event->getOrder();

        if($order->getId() && $order->canInvoice() && $order->getPayment()->getMethod()=="oprekening"){

			$invoice = $order->prepareInvoice();
			$invoice->setRequestedCaptureCase('not_capture');
			$invoice->register();

			Mage::getModel('core/resource_transaction')
				->addObject($invoice)
				->addObject($invoice->getOrder())
				->save();

			$order->addStatusToHistory($order->getStatus(), Mage::helper('oprekening')->__('Invoice created!'));
        }
	}
}
?>
