<?php

namespace Tiendamia\Challenge\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Tiendamia\Challenge\Api\Data\BestOfferOptionsInterface;

class BestOfferOptions implements OptionSourceInterface, BestOfferOptionsInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::LOWEST_PRICE,
                'label' => __('Lowest Price')
            ],
            [
                'value' => self::POSITIVE_SELLER_QUALIFICATION,
                'label' => __('Positive Seller Qualification')
            ],
            [
                'value' => self::EARLIEST_DELIVERY_DATE,
                'label' => __('Earliest delivery date')
            ],
            [
                'value' => self::LOWEST_SHIPPING_COST,
                'label' => __('Lowest shipping cost')
            ],
            //These options can be used in combination with previous options
            [
                'value' => self::GUARANTEE_AVAILABILITY,
                'label' => __('Guarantee Availability')
            ],
            [
                'value' => self::REFUND_AVAILABILITY,
                'label' => __('Refund Availability')
            ],
        ];
    }
}
