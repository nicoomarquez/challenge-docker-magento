<?php

namespace Tiendamia\Challenge\Api;

use Tiendamia\Challenge\Api\Data\OfferInterface;

/**
 * Interface BestOfferCalculatorInterface
 * @api
 **/
interface BestOfferCalculatorInterface
{
    /**
     * Returns best offer available for a given product.
     * @param string $sku
     * @return OfferInterface
     */
    public function calculate(string $sku): OfferInterface;
}
