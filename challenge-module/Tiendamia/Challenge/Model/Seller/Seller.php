<?php

namespace Tiendamia\Challenge\Model\Seller;

use Magento\Framework\DataObject;
use Tiendamia\Challenge\Api\Data\SellerInterface;

class Seller extends DataObject implements SellerInterface
{

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData($name, self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function getQualification()
    {
        return $this->_getData(self::QUALIFICATION);
    }

    /**
     * @inheritDoc
     */
    public function setQualification($qualification)
    {
        return $this->setData($qualification, self::QUALIFICATION);
    }

    /**
     * @inheritDoc
     */
    public function getReviewsQuantity()
    {
        return $this->_getData(self::REVIEWS_QUANTITY);
    }

    /**
     * @inheritDoc
     */
    public function setReviewsQuantity($reviewsQuantity)
    {
        return $this->setData($reviewsQuantity, self::REVIEWS_QUANTITY);
    }
}
