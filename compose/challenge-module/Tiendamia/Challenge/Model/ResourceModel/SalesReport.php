<?php

namespace Tiendamia\Challenge\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class SalesReport extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }


    protected function _construct()
    {
        $this->_init('sales_report', 'id');
    }
}
