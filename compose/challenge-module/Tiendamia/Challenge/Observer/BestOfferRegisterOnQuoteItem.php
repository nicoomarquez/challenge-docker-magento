<?php

namespace Tiendamia\Challenge\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\Quote\Item;
use Tiendamia\Challenge\Model\Offer\BestOfferCalculator;

class BestOfferRegisterOnQuoteItem implements ObserverInterface
{
    /**
     * @param BestOfferCalculator $bestOfferCalculator
     */
    public function __construct(
        private BestOfferCalculator $bestOfferCalculator,
    ) {
    }

    /**
     * Executes sales_quote_product_add_after event
     *
     * @param Observer $observer
     * @return void
     * @throws LocalizedException
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
