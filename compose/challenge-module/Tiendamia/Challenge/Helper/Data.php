<?php

namespace Tiendamia\Challenge\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * Section Offer Selection criteria
     */
    const XML_PATH_SELECTION_CRITERIA = 'offer/selection/criteria';

    /**
     * Section Provider API
     */
    const XML_PATH_PROVIDER_HOST = 'provider/api/host';

    const XML_PATH_PROVIDER_OFFERS_ENDPOINT = 'provider/api/offers_endpoint';

    /**
     * Retrieve Offer Selection Criteria
     *
     * @return int|null
     */
    public function getOfferSelectionCriteria(): ?int
    {
        $criteriaCode = $this->scopeConfig->getValue(
            self::XML_PATH_SELECTION_CRITERIA,
            ScopeInterface::SCOPE_STORE
        );
        return isset($criteriaCode) ? (int)$criteriaCode : null;
    }

    /**
     * Retireve Provider host
     *
     * @return string
     */
    public function getProviderHost(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PROVIDER_HOST,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve provider offers endpoint
     *
     * @return string
     */
    public function getProviderOffersEndpoint(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_PROVIDER_OFFERS_ENDPOINT,
            ScopeInterface::SCOPE_STORE
        );
    }
}
