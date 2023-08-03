<?php

namespace Tiendamia\Challenge\Model\Provider;

use Tiendamia\Challenge\Api\Data\OfferInterface;
use Tiendamia\Challenge\Model\Util\ParseOfferFromArray;
use Tiendamia\Challenge\Service\ProviderApiService;

class OfferRetriever
{
    /**
     * @param ProviderApiService $providerApiService
     * @param ParseOfferFromArray $parseOfferFromArray
     */
    public function __construct(
        private ProviderApiService $providerApiService,
        private ParseOfferFromArray $parseOfferFromArray
    ) {
    }

    /**
     * Get Offers for a given product
     *
     * @param $sku
     * @return OfferInterface[]
     * @throws \Exception
     */
    public function getOffersBySku($sku) {
        $offersResult = [];
        $response = $this->providerApiService->getBestOfferBySku($sku);
        foreach ($response['offers'] as $offer) {
            $offersResult[] = $this->parseOfferFromArray->parse($offer);
        }

        return $offersResult;
    }
}
