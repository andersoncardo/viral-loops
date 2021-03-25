<?php


namespace Cardoso\ViralLoops\Api\Data;


/**
 * Interface ManagementInterface
 * @package Cardoso\ViralLoops\Api\Data
 */
interface ManagementInterface
{
    const ENTITY_ID = 'entity_id';
    const REFERRAL_CODE_ORIGIN = 'referral_code_origin';
    const REFERRAL_CODE_CUSTOMER = 'referral_code_customer';
    const COUPON_CODE = 'coupon_code';
    const COUPON_ID = 'coupon_id';
    const COUPON_VALUE = 'coupon_value';
    const CREATED_AT = 'created_at';
    const CUSTOMER_ID = 'customer_id';
    const IS_USED = 'is_used';

    /**
     * @param $entityId
     * @return ManagementInterface
     */
    public function setEntityId($entityId);

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param $referralCodeOrigin
     * @return ManagementInterface
     */
    public function setReferralCodeOrigin($referralCodeOrigin);

    /**
     * @return mixed
     */
    public function getReferralCodeOrigin();

    /**
     * @param $referralCodeCustomer
     * @return ManagementInterface
     */
    public function setReferralCodeCustomer($referralCodeCustomer);

    /**
     * @return mixed
     */
    public function getReferralCodeCustomer();

    /**
     * @param $couponCode
     * @return ManagementInterface
     */
    public function setCouponCode($couponCode);

    /**
     * @return mixed
     */
    public function getCouponCode();

    /**
     * @param $couponId
     * @return ManagementInterface
     */
    public function setCouponId($couponId);

    /**
     * @return mixed
     */
    public function getCouponId();

    /**
     * @param $couponValue
     * @return ManagementInterface
     */
    public function setCouponValue($couponValue);

    /**
     * @return mixed
     */
    public function getCouponValue();

    /**
     * @param $createdAt
     * @return ManagementInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $customerId
     * @return ManagementInterface
     */
    public function setCustomerId($customerId);

    /**
     * @return mixed
     */
    public function getCustomerId();
    /**
     * @param $isUsed
     * @return ManagementInterface
     */
    public function setIsUsed($isUsed);

    /**
     * @return mixed
     */
    public function getIsUsed();
}
