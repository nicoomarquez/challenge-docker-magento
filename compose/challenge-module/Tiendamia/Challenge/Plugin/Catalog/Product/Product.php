<?php

namespace Tiendamia\Challenge\Plugin\Catalog\Product;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Tiendamia\Challenge\Model\Offer\BestOfferCalculator;

class Product
{
    /**
     * @param BestOfferCalculator $bestOfferCalculator
     * @param PsrLoggerInterface $logger
     */
    public function __construct(
        private BestOfferCalculator $bestOfferCalculator,
        private PsrLoggerInterface  $logger
    ) {
    }

    /**
     * Calculate best offer price for a giving product and sets it
     *
     * @param ProductInterface $subject
     * @param $result
     * @return float
     * @throws LocalizedException
     */
    public function afterGetPrice(ProductInterface $subject, $result)
    {
        $bestOffer = $this->bestOfferCalculator->calculate($subject->getSku());
        return $bestOffer->getPrice();
    }
}
