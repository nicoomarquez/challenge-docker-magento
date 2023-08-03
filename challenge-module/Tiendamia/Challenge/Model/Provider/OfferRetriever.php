<?php

namespace Tiendamia\Challenge\Model\Provider;

use Tiendamia\Challenge\Model\Util\ParseOfferFromArray;
use Tiendamia\Challenge\Service\ProviderApiService;

class OfferRetriever
{
    public function __construct(
        private ProviderApiService $providerApiService,
        private ParseOfferFromArray $parseOfferFromArray
    ) {}

    public function getOffersBySku($sku) {
        $offersResult = [];
        $response = $this->providerApiService->getBestOfferBySku($sku);
        foreach ($response['offers'] as $offer) {
            $offersResult[] = $this->parseOfferFromArray->parse($offer);
        }

        return $offersResult;
    }
}
