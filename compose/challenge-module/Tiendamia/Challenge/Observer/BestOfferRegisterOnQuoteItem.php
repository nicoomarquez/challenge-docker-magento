<?php

namespace Tiendamia\Challenge\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Item;
use Tiendamia\Challenge\Model\Offer\BestOfferCalculator;

class BestOfferRegisterOnQuoteItem implements ObserverInterface
{
    public function __construct(
        private BestOfferCalculator $bestOfferCalculator,

    ) {}
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $itemsAdded = $observer->getEvent()->getData('items');
        /**
         * @var Item $item
         */
        foreach ($itemsAdded as $item) {
            if ($item->getProductType() == 'simple') {
                $bestOffer = $this->bestOfferCalculator->calculate($item->getSku());
                $item->setOfferId($bestOffer->getId());
            }
        }
    }
}
