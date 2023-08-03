<?php

namespace Tiendamia\Challenge\Api\Data;

interface OfferInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    const ID = 'id';

    const PRICE = 'price';

    const STOCK = 'stock';

    const SHIPPING_PRICE = 'shipping_price';

    const DELIVERY_DATE = 'delivery_date';

    const CAN_BE_REFUNDED = 'can_be_refunded';

    const STATUS = 'status';

    const GUARANTEE = 'guarantee';

    const SELLER = 'seller';

    /**
     * Seller ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set Seller ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Seller price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Set Seller price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * Seller stock
     *
     * @return int
     */
    public function getStock();

    /**
     * Set Seller stock
     *
     * @param int $stock
     * @return $this
     */
    public function setStock($stock);

    /**
     * Seller Shipping Price
     *
     * @return float
     */
    public function getShippingPrice();

    /**
     * Set Seller Shipping Price
     *
     * @param float $shippingPrice
     * @return $this
     */
    public function setShippingPrice($shippingPrice);

    /**
     * Seller Delivery Date
     *
     * @return string
     */
    public function getDeliveryDate();

    /**
     * Set Offer Delivery Date
     *
     * @param string $deliveryDate
     * @return $this
     */
    public function setDeliveryDate($deliveryDate);

    /**
     * Offer Can be refunded
     *
     * @return bool
     */
    public function getCanBeRefunded();

    /**
     * Set Offer Can be refunded
     *
     * @param bool $canBeRefunded
     * @return $this
     */
    public function setCanBeRefunded($canBeRefunded);

    /**
     * Offer Status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set Offer Status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Offer Guarantee
     *
     * @return bool
     */
    public function getGuarantee();

    /**
     * Set Offer Guarantee
     *
     * @param bool $guarantee
     * @return $this
     */
    public function setGuarantee($guarantee);

    /**
     * Offer Seller
     *
     * @return SellerInterface
     */
    public function getSeller();

    /**
     * Set Offer Seller
     *
     * @param string $seller
     * @return $this
     */
    public function setSeller($seller);
}
