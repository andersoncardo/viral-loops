<?php


namespace Cardoso\ViralLoops\Model\Rewarding\Management\Order;


use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderInterface;
use Cardoso\ViralLoops\Api\Data\ManagementInterface;
use Cardoso\ViralLoops\Model\Rewarding\Management\TransactionAbstract;

class CouponRedeemed extends TransactionAbstract
{
    /**
     * @param OrderInterface $order
     * @return $this|int|null
     * @throws AlreadyExistsException
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function manageCouponIsRedeemed(OrderInterface $order)
    {
        $couponCode = $order->getCouponCode();
        $ruleId = $this->config->getRuleReferralId();
        $couponData = $this->getCouponData($couponCode);
        if (!$couponData) {
            return $this;
        }
        $referralCodeCustomer = $couponData->getReferralCodeCustomer()->getData('referral_code_origin');
        $transactionId = $couponData->getReferralCodeCustomer()->getData('coupon_id');
        $payload = $this->eventAction->getOrderPaymentRequestParams($order, $referralCodeCustomer);
        $response = $this->connectApi->request(self::METHOD_POST, self::PATH_URL_ACTION, $payload);
        if (!is_array($response) || !$response['code'] == '200') {
            return $this;
        }
       // $response = '{"eventId":"evt_ZjAzZDBlZGNmNGI2N2E4MTMyNWQ","rewards":[{"user":{"firstname":"João","lastname":"Roosevelt","email":"andersoncardo+235@gmail.com","referralCode":"580DMVB"},"id":"reward_Y2JiNjg1Zjc4MzY0NTYwYzY5ZTE","coupon":{"name":"6565","value":40,"type":"amount","settings":{"minimumOrderTotal":0,"useInShipping":1,"totalUses":1}}}]}';

        $body = json_decode($response['body']);
        if (!$this->managementCoupon->responseHasCouponRedeemed($body)) {
            return $this;
        }
        $baseCoupon = $this->getBaseCoupon($body, $ruleId, $referralCodeCustomer, 'order');
        return $this->processTransaction($baseCoupon, $couponData, $transactionId);
    }

    /**
     * @param $baseCoupon
     * @param $couponData
     * @return int|null
     * @throws AlreadyExistsException
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    protected function processTransaction($baseCoupon, $couponData, $transactionId): ?int
    {
        $coupon = $this->coupon->createCoupon($baseCoupon);
        if ($coupon) {
           // $this->registerTransaction->update($couponData->getId());
            $this->markCouponAsRedeemed($transactionId);
        }
        return $coupon;
    }

    /**
     * @param $couponCode
     * @return ManagementInterface
     */
    public function getCouponData($couponCode): ?ManagementInterface
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('coupon_code', $couponCode, 'eq');
        $searchCriteria = $searchCriteria->create();
        $referralCode = $this->managementRepository->getList($searchCriteria);

        if (!$referralCode->getItems()) {
            return null;
        }
        return current($referralCode->getItems());
    }

    public function markCouponAsRedeemed($transactionId)
    {
        $payload = $this->eventAction->getCouponAsRedeemedParams($transactionId);
        $response = $this->connectApi->request(self::METHOD_POST, self::API_URL_ACTION . self::REDEEMED_PATH, $payload);
        if (!is_array($response) || !$response['code'] == '200') {
            return false;
        }
        return true;

    }
}
