<?php

namespace Tiendamia\Challenge\Plugin\Quote\Item;

use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Quote\Model\Quote\Item\ToOrderItem;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\Order\Item;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

class ConvertToOrderItem
{
    /**
     * Intercepts after convert an item
     *
     * @param ToOrderItem $subject
     * @param OrderItemInterface $orderItem
     * @param AbstractItem $item
     * @param $additional
     * @return OrderItemInterface
     */
    public function afterConvert(
        ToOrderItem $subject,
        OrderItemInterface $orderItem,
        AbstractItem $item,
        $additional = []
    ) {
        $orderItem->setOfferId($item->getOfferId());
        return $orderItem;
    }
}
