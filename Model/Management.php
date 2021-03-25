<?php


namespace Cardoso\ViralLoops\Model;

use Magento\Framework\Model\AbstractModel;
use Cardoso\ViralLoops\Api\Data\ManagementInterface;

class Management extends AbstractModel implements ManagementInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Management::class);
    }

    /**
     * @param int $entityId
     * @return ManagementInterface
     */
    public function setEntityId($entityId)
    {
        $this->setData(ManagementInterface::ENTITY_ID, $entityId);
        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getEntityId()
    {
        return $this->getData(ManagementInterface::ENTITY_ID);
    }

    /**
     * @param $referralCodeOrigin
     * @return ManagementInterface
     */
    public function setReferralCodeOrigin($referralCodeOrigin)
    {
        $this->setData(ManagementInterface::REFERRAL_CODE_ORIGIN, $referralCodeOrigin);
        return $this;
    }

    public function getReferralCodeOrigin()
    {
        return $this->getData(ManagementInterface::REFERRAL_CODE_ORIGIN);
    }

    /**
     * @param $referralCodeCustomer
     * @return ManagementInterface
     */
    public function setReferralCodeCustomer($referralCodeCustomer)
    {
        $this->setData(ManagementInterface::REFERRAL_CODE_CUSTOMER, $referralCodeCustomer);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getReferralCodeCustomer()
    {
        return $this->setData(ManagementInterface::REFERRAL_CODE_CUSTOMER);
    }

    /**
     * @param $couponCode
     * @return ManagementInterface
     */
    public function setCouponCode($couponCode)
    {
        $this->setData(ManagementInterface::COUPON_CODE, $couponCode);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getCouponCode()
    {
        return $this->setData(ManagementInterface::COUPON_CODE);
    }

    /**
     * @param $couponId
     * @return ManagementInterface
     */
    public function setCouponId($couponId)
    {
        $this->setData(ManagementInterface::COUPON_ID, $couponId);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getCouponId()
    {
       return $this->setData(ManagementInterface::COUPON_ID);
    }

    /**
     * @param $couponValue
     * @return ManagementInterface
     */
    public function setCouponValue($couponValue)
    {
        $this->setData(ManagementInterface::COUPON_VALUE, $couponValue);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getCouponValue()
    {
        return $this->setData(ManagementInterface::COUPON_VALUE);
    }

    /**
     * @param $createdAt
     * @return ManagementInterface
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(ManagementInterface::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getCreatedAt()
    {
       return $this->setData(ManagementInterface::CREATED_AT);
    }

    /**
     * @param $customerId
     * @return ManagementInterface
     */
    public function setCustomerId($customerId)
    {
        $this->setData(ManagementInterface::CUSTOMER_ID, $customerId);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getCustomerId()
    {
        return $this->setData(ManagementInterface::CUSTOMER_ID);
    }

    /**
     * @param $isUsed
     * @return ManagementInterface
     */
    public function setIsUsed($isUsed)
    {
        $this->setData(ManagementInterface::IS_USED, $isUsed);
        return $this;
    }

    /**
     * @return mixed|Management
     */
    public function getIsUsed()
    {
        return $this->setData(ManagementInterface::IS_USED);
    }
}
