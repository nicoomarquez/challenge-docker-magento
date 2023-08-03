<?php

namespace Tiendamia\Challenge\Model;

use Magento\Framework\Model\AbstractModel;

class SalesReport extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tiendamia\Challenge\Model\ResourceModel\SalesReport');
    }
}
