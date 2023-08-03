<?php

namespace Tiendamia\Challenge\Api\Data;

interface SellerInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    const NAME = 'name';

    const QUALIFICATION = 'qualification';

    const REVIEWS_QUANTITY = 'reviews_quantity';

    /**
     * Seller name
     *
     * @return string
     */
    public function getName();

    /**
     * Set Seller name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Seller qualification
     *
     * @return int
     */
    public function getQualification();

    /**
     * Set Seller qualification
     *
     * @param int $qualification
     * @return $this
     */
    public function setQualification($qualification);

    /**
     * Seller reviews quantity
     *
     * @return int
     */
    public function getReviewsQuantity();

    /**
     * Set Seller reviews quantity
     *
     * @param int $reviewsQuantity
     * @return $this
     */
    public function setReviewsQuantity($reviewsQuantity);
}
