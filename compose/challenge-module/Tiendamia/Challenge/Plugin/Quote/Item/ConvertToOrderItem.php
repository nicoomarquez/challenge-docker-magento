<?php

namespace Tiendamia\Challenge\Plugin\Quote\Item;

use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Quote\Model\Quote\Item\ToOrderItem;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\Order\Item;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

class ConvertToOrderItem
{

    public function __construct(
        private PsrLoggerInterface $logger
    )
    {
    }
    public function afterConvert(
        ToOrderItem $subject,
        OrderItemInterface $orderItem,
        AbstractItem $item,
        $additional = []
    ) {
        $orderItem->setOfferId($item->getOfferId());
        return $orderItem;
    }
//    public function aroundConvert(
//        ToOrderItem  $subject,
//        \Closure     $proceed,
//        AbstractItem $item,
//                     $additional = []
//    ) {
//        /** @var Item $orderItem */
//        $orderItem = $proceed($item, $additional);
//        $orderItem->setOfferId($item->getOfferId());
//
//        return $orderItem;
//    }
}
