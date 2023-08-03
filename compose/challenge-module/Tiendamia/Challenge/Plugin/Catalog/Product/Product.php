<?php

namespace Tiendamia\Challenge\Plugin\Catalog\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Tiendamia\Challenge\Model\Offer\BestOfferCalculator;

class Product
{
    public function __construct(
        private BestOfferCalculator $bestOfferCalculator,
        private PsrLoggerInterface $logger
    ) {}

    public function afterGetPrice(ProductInterface $subject, $result)
    {
        $bestOffer = $this->bestOfferCalculator->calculate($subject->getSku());
        return $bestOffer->getPrice();
    }
}
