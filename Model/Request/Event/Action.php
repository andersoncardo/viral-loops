<?php


namespace Cardoso\ViralLoops\Model\Request\Event;


use Magento\Sales\Api\Data\OrderInterface;
use Cardoso\ViralLoops\Model\Config;

class Action
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * EventAbstract constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @return bool
     */
    public function getToken(): bool
    {
        return $this->config->getToken('token');
    }

    /**
     * @return bool
     */
    public function getUrl(): bool
    {
        return $this->config->getUrl('url');
    }

    /**
     * @param $customer
     * @param $referralCode
     * @return array
     */
    public function getActionParams($customer, $referralCode): array
    {
        $token = $this->config->getToken();

        return [
            'apiToken' => $token,
            'params' => [
                'event' => 'action',
                'user' => [
                    'firstname' => $customer->getData('firstname'),
                    'lastname' =>  $customer->getData('lastname'),
                    'email' => $customer->getEmail(),
                ],
                'referrer' => [
                    'referralCode' => $referralCode,
                ],
            ],
        ];

    }

    /**
     * @param OrderInterface $order
     * @param $referralCode
     * @return array
     */
    public function getOrderPaymentRequestParams(OrderInterface $order, $referralCode): array
    {
        $token = $this->config->getToken();
        return [
            'apiToken' => $token,
            'params' => [
                'event' => 'order',
                'user' => [
                    'referralCode' => $referralCode,
                ],
                'amount' => $order->getBaseSubtotal(),
            ],
        ];
    }

    /**
     * @param $transactionId
     * @return array
     */
   public function getCouponAsRedeemedParams($transactionId): array
    {
        $token = $this->config->getToken();
        return [
            'rewardId' => $transactionId,
            'apiToken' =>  $token,
        ];
    }

}
