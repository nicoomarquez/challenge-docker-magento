<?php

namespace Tiendamia\Challenge\Model\Offer;

use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Tiendamia\Challenge\Api\Data\BestOfferOptionsInterface;
use Tiendamia\Challenge\Api\Data\OfferInterface;
use Tiendamia\Challenge\Helper\Data as HelperData;
use Tiendamia\Challenge\Model\Provider\OfferRetriever;

class BestOfferCalculator
{
    /**
     * @param OfferRetriever $offerRetriever
     * @param HelperData $helperData
     * @param PsrLoggerInterface $logger
     */
    public function __construct(
        private OfferRetriever     $offerRetriever,
        private HelperData         $helperData,
        private PsrLoggerInterface $logger
    ) {
    }

    /**
     * Calculate best offer for a given product sku
     *
     * @param string $sku
     * @return OfferInterface|null
     */
    public function calculate(string $sku)
    {
        $bestOffer = null;
        try {
            $offers = $this->offerRetriever->getOffersBySku($sku);
            $selectionCriteriaCode = $this->helperData->getOfferSelectionCriteria();

            if ($selectionCriteriaCode == BestOfferOptionsInterface::LOWEST_PRICE) {
                $bestOffer = $this->_getOfferWithLowestPrice($offers);
            } elseif ($selectionCriteriaCode == BestOfferOptionsInterface::EARLIEST_DELIVERY_DATE) {
                $bestOffer = $this->_getOfferWithEarliestDeliveryDate($offers);
            } elseif ($selectionCriteriaCode == BestOfferOptionsInterface::LOWEST_SHIPPING_COST) {
                $bestOffer = $this->_getOfferWithLowestShippingCost($offers);
            } elseif ($selectionCriteriaCode == BestOfferOptionsInterface::GUARANTEE_AVAILABILITY) {
                $bestOffer = $this->_getOfferWithGuaranteeAvailability($offers);
            } elseif ($selectionCriteriaCode == BestOfferOptionsInterface::REFUND_AVAILABILITY) {
                $bestOffer = $this->_getOfferWithRefundAvailability($offers);
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__('Offers not found'));
        }

        return $bestOffer;
    }

    /**
     * Calculates best offer using "Lowest price" criteria
     *
     * @param mixed $offers
     * @return OfferInterface
     */
    private function _getOfferWithLowestPrice($offers): ?OfferInterface
    {
        $bestOffer = null;
        if (count($offers) >= 1) {
            usort($offers, function ($offerA, $offerB) {
                return $offerA['price'] - $offerB['price'];
            });
            $bestOffer = $offers[0];
        }
        return $bestOffer;
    }

    /**
     * Calculates best offer using "Earliest delivery date" criteria
     *
     * @param mixed $offers
     * @return OfferInterface
     */
    private function _getOfferWithEarliestDeliveryDate($offers): ?OfferInterface
    {
        $bestOffer = null;
        if (count($offers) >= 1) {
            usort($offers, function ($offerA, $offerB) {
                return strtotime($offerA['delivery_date']) - strtotime($offerB['delivery_date']);
            });
            $bestOffer = $offers[0];
        }
        return $bestOffer;
    }

    /**
     * Calculates best offer using "Guarantee Availability" criteria
     *
     * @param mixed $offers
     * @return OfferInterface
     */
    private function _getOfferWithGuaranteeAvailability($offers): ?OfferInterface
    {
        $bestOffer = null;
        if (count($offers) >= 1) {
            usort($offers, function ($offerA, $offerB) {
                return $offerA['guarantee'] === $offerB['guarantee'] ? 0 : ($offerA['guarantee'] ? -1 : 1);
            });
            $bestOffer = $offers[0];
        }
        return $bestOffer;
    }

    /**
     * Calculates best offer using "Lowest shipping cost" criteria
     *
     * @param mixed $offers
     * @return OfferInterface
     */
    private function _getOfferWithLowestShippingCost($offers): ?OfferInterface
    {
        $bestOffer = null;
        if (count($offers) >= 1) {
            usort($offers, function ($offerA, $offerB) {
                return $offerA['shipping_price'] - $offerB['shipping_price'];
            });
            $bestOffer = $offers[0];
        }
        return $bestOffer;
    }

    /**
     * Calculates best offer using "Refund Availability" criteria
     *
     * @param mixed $offers
     * @return OfferInterface
     */
    private function _getOfferWithRefundAvailability($offers): ?OfferInterface
    {
        $bestOffer = null;
        if (count($offers) >= 1) {
            usort($offers, function ($offerA, $offerB) {
                return $offerA['can_be_refunded'] === $offerB['can_be_refunded'] ?
                    0 : ($offerA['can_be_refunded'] ? -1 : 1);
            });
            $bestOffer = $offers[0];
        }
        return $bestOffer;
    }
}
