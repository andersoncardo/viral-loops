<?php
declare(strict_types=1);

namespace Cardoso\ViralLoops\Controller\Referal;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException;
use Magento\Framework\Stdlib\Cookie\FailureToSendException;
use Magento\Framework\View\Result\PageFactory;
use Cardoso\ViralLoops\Helper\Cookie as ReferralCodeCookie;

class Index extends \Magento\Framework\App\Action\Action
{
    const SUCCESS_MESSAGE = 'You need to log in to effect your discount';
    const ERROR_MESSAGE = 'We had a problem when making your discount, contact our support';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ReferralCodeCookie
     */
    protected $referralCodeCookie;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ReferralCodeCookie $referralCodeCookie
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ReferralCodeCookie $referralCodeCookie,
        ManagerInterface $messageManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->referralCodeCookie = $referralCodeCookie;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl('/customer/account/');

        $params = $this->getRequest()->getParams();
        if ($params['referralCode']) {
            $referralCode = $params['referralCode'];
            try {
                $this->referralCodeCookie->setCookie($referralCode);
                $message = __(self::SUCCESS_MESSAGE);
                $this->messageManager->addSuccessMessage($message);

            } catch (InputException | CookieSizeLimitReachedException $e) {
            } catch (FailureToSendException $e) {
                $message = __(self::ERROR_MESSAGE);
                $this->messageManager->addErrorMessage($message);
            }
        }
        return $redirect;
    }
}

