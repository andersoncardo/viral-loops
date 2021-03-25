<?php


namespace Cardoso\ViralLoops\Model\Rewarding\Management;


use Magento\Customer\Model\Customer;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\Cookie\FailureToSendException;

class Transaction extends TransactionAbstract
{


    /**
     * @param Customer $customer
     * @return $this|false
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function manageRewarding(Customer $customer)
    {
        $result = null;
        $coupon =  null;
        $referralCodeOrigin = $this->referralCookieManager->getCookie(self::COOKIE_NAME);
        if (!$referralCodeOrigin) {
            return $this;
        }

        $payload = $this->eventAction->getActionParams($customer, $referralCodeOrigin);
        $response = $this->connectApi->request(self::METHOD_POST, self::PATH_URL_ACTION, $payload);
        if (!is_array($response) || !$response['code'] == '200') {
            return $this;
        }

        $body = json_decode($response['body']);
        $ruleId = $this->config->getRuleId();
        if (!$this->managementCoupon->responseHasCoupon($body)) {
            return $this;
        }
        $baseCoupon = $this->getBaseCoupon($body, $ruleId, $referralCodeOrigin);
        return $this->processTransaction($customer, $baseCoupon);
    }

    /**
     * @param Customer $customer
     * @param $baseCoupon
     * @return int
     * @throws AlreadyExistsException
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    protected function processTransaction(Customer $customer, $baseCoupon): ?int
    {

        $coupon = $this->coupon->createCoupon($baseCoupon);
        if ($coupon) {
            $this->registerTransaction->create($customer, $baseCoupon);
        }
        return $coupon;
    }




}
