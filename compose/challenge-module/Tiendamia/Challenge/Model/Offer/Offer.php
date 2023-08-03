<?php

namespace Tiendamia\Challenge\Model\Offer;

use Magento\Framework\DataObject;
use Tiendamia\Challenge\Api\Data\OfferInterface;
use Tiendamia\Challenge\Model\Seller\Seller;

class Offer extends DataObject implements OfferInterface
{
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(OfferInterface::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(OfferInterface::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getPrice()
    {
        return $this->getData(OfferInterface::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price)
    {
        return $this->setData(OfferInterface::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function getStock()
    {
        return $this->getData(OfferInterface::STOCK);
    }

    /**
     * @inheritDoc
     */
    public function setStock($stock)
    {
        return $this->setData(OfferInterface::STOCK, $stock);
    }

    /**
     * @inheritDoc
     */
    public function getShippingPrice()
    {
        return $this->getData(OfferInterface::SHIPPING_PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setShippingPrice($shippingPrice)
    {
        return $this->setData(OfferInterface::SHIPPING_PRICE, $shippingPrice);
    }

    /**
     * @inheritDoc
     */
    public function getDeliveryDate()
    {
        return $this->getData(OfferInterface::DELIVERY_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setDeliveryDate($deliveryDate)
    {
        return $this->setData(OfferInterface::DELIVERY_DATE, $deliveryDate);
    }

    /**
     * @inheritDoc
     */
    public function getCanBeRefunded()
    {
        return $this->getData(OfferInterface::CAN_BE_REFUNDED);
    }

    /**
     * @inheritDoc
     */
    public function setCanBeRefunded($canBeRefunded)
    {
        return $this->setData(OfferInterface::CAN_BE_REFUNDED, $canBeRefunded);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(OfferInterface::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(OfferInterface::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getGuarantee()
    {
        return $this->getData(OfferInterface::GUARANTEE);
    }

    /**
     * @inheritDoc
     */
    public function setGuarantee($guarantee)
    {
        return $this->setData(OfferInterface::GUARANTEE, $guarantee);
    }

    /**
     * @inheritDoc
     */
    public function getSeller()
    {
        return $this->getData(OfferInterface::SELLER);
    }

    /**
     * @inheritDoc
     */
    public function setSeller($seller)
    {
        return $this->setData(OfferInterface::SELLER, $seller);
    }
}
