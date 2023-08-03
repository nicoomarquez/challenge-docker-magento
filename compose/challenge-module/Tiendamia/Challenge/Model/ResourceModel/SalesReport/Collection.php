<?php

namespace Tiendamia\Challenge\Model\ResourceModel\SalesReport;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Tiendamia\Challenge\Model\SalesReport', 'Tiendamia\Challenge\Model\ResourceModel\SalesReport');
    }
}
