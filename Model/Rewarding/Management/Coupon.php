<?php


namespace Cardoso\ViralLoops\Model\Rewarding\Management;


class Coupon
{
    const REFERRAL_CODE = 'referralCode';

    /**
     * @var string[]
     */
    protected  $baseCoupon = [
        'code' => '',
        'createdAt' => '',
        'referralCode' => '',
        'transaction_id' =>'',
        'ReferralCodeOrigin' => '',
        'coupon_value' => '',
        'ruleId' => '',
    ];

    /**
     * Valid is has coupon in the api response
     * @param $body
     * @return bool|null
     */
    public function responseHasCoupon($body): ?bool
    {
        if (!$body) {
            return false;
        }
        foreach ($body as $item => $key) {
            if ($item == self::REFERRAL_CODE) {
                return true;
            }
        }
        return false;
    }
    /**
     * Valid is has coupon in the api response
     * @param $body
     * @return bool|null
     */
    public function responseHasCouponRedeemed($body): ?bool
    {
        if (!$body) {
            return false;
        }
      if ($body->rewards) {
          return true;
      }
        return false;
    }


    /**
     * @param $couponBody
     * @param $ruleId
     * @param $referralCodeOrigin
     * @param string $origin
     * @return array|false|string[]
     */
    public function prepareCoupon($couponBody, $ruleId, $referralCodeOrigin, $origin = 'action')
    {
        if (!$ruleId) {
            return false;
        }
        $createdAt = date('Y-m-d');
        if ($origin == 'action') {
            return $this->getBaseCouponActionOrigin($couponBody, $createdAt, $ruleId, $referralCodeOrigin);
        }
        return $this->getCouponRedeemed($couponBody, $createdAt, $ruleId, $referralCodeOrigin);

    }

    /**
     * @param $couponBody
     * @param bool $createdAt
     * @param $ruleId
     * @param $referralCodeOrigin
     * @return array
     */
    protected function getCouponRedeemed($couponBody, bool $createdAt, $ruleId, $referralCodeOrigin): array
    {
        $rewarding = $couponBody->rewards;
        foreach ($rewarding as $value) {
            $referral = $couponBody->rewards[0];
            $this->baseCoupon = [
                'code' => $value->coupon->name,
                'createdAt' => $createdAt,
                'referralCode' => $referral->user->referralCode,
                'transaction_id' => $value->id,
                'coupon_value' => $value->coupon->value,
                'ReferralCodeOrigin' => $referralCodeOrigin,
                'ruleId' => $ruleId,
            ];
        }
        return $this->baseCoupon;
    }

    /**
     * @param $couponBody
     * @param bool $createdAt
     * @param $ruleId
     * @param $referralCodeOrigin
     * @return array
     */
    protected function getBaseCouponActionOrigin($couponBody, bool $createdAt, $ruleId, $referralCodeOrigin): array
    {
        $rewarding = $couponBody->rewards;
        foreach ($rewarding as $value) {
            $this->baseCoupon = [
                'code' => $value->coupon->name,
                'createdAt' => $createdAt,
                'referralCode' => $couponBody->referralCode,
                'transaction_id' => $value->id,
                'coupon_value' => $value->coupon->value,
                'ReferralCodeOrigin' => $referralCodeOrigin,
                'ruleId' => $ruleId,
            ];
        }
        return $this->baseCoupon;
    }

}
