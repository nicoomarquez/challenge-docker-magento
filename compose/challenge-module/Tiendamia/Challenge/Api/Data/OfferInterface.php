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
     * Get Offer ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set Offer ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Offer price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Set Offer price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * Get Offer stock
     *
     * @return int
     */
    public function getStock();

    /**
     * Set Offer stock
     *
     * @param int $stock
     * @return $this
     */
    public function setStock($stock);

    /**
     * Get Offer Shipping Price
     *
     * @return float
     */
    public function getShippingPrice();

    /**
     * Set Offer Shipping Price
     *
     * @param float $shippingPrice
     * @return $this
     */
    public function setShippingPrice($shippingPrice);

    /**
     * Get Offer Delivery Date
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
     * Get Offer Can be refunded
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
     * Get Offer Status
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
     * Get Offer Guarantee
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
     * Get Offer Seller
     *
     * @return \Tiendamia\Challenge\Api\Data\SellerInterface
     */
    public function getSeller();

    /**
     * Set Offer Seller
     *
     * @param \Tiendamia\Challenge\Api\Data\SellerInterface $seller
     * @return $this
     */
    public function setSeller($seller);
}
