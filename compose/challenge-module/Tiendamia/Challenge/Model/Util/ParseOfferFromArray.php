<?php

namespace Tiendamia\Challenge\Model\Util;

use Tiendamia\Challenge\Api\Data\OfferInterface;
use Tiendamia\Challenge\Model\Offer\OfferFactory;
use Tiendamia\Challenge\Model\Offer\Offer;
use Tiendamia\Challenge\Model\Seller\SellerFactory;
use Tiendamia\Challenge\Model\Seller\Seller;

class ParseOfferFromArray
{
    /**
     * @param OfferFactory $offerFactory
     * @param SellerFactory $sellerFactory
     */
    public function __construct(
        private OfferFactory $offerFactory,
        private SellerFactory $sellerFactory,
    ){}

    /**
     * @param $offerData
     * @return OfferInterface
     */
    public function parse($offerData) {
        $sellerData = $offerData['seller'];
        unset($offerData['seller']);

        /**
         * @var Offer $offer
         */
        $offer = $this->offerFactory->create();
        $offer->addData($offerData);

        /**
         * @var Seller $seller
         */
        $seller = $this->sellerFactory->create();
        $seller->addData($sellerData);

        $offer->setSeller($seller);

        return $offer;
    }
}
