<?php
/**
 * @category    Mamoc
 * @package     Mamoc_Oprekening
 * @copyright   Copyright (c) 2012 MaMoC BV (http://www.mamoc.net)
 */

class Mamoc_OpRekening_Model_Oprekening extends Mage_Payment_Model_Method_Abstract
{

    protected $_code  = 'oprekening';

	protected $_canCapture    = true;

}
