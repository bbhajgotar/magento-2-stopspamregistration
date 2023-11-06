<?php
namespace Y2B\StopSpamRegistration\Plugin;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\RequestInterface;
use Y2B\StopSpamRegistration\Helper\Data as DataHelper;

class CheckspamNewsletter
{
    public function __construct(
        ManagerInterface $messageManager,
        RequestInterface $request,
        DataHelper $helper) {
        $this->_messageManager = $messageManager;
        $this->getRequest = $request;
        $this->helper = $helper;
    }

    public function beforeExecute(\Magento\Newsletter\Controller\Subscriber\NewAction $subject)
    {

        $_enable = $this->helper->getEnable();
        $_enableNewsletter = $this->helper->getNewsletterRegistrationEnable();

        if ($_enable && $_enableNewsletter) {
            $_spamKeywords = $this->helper->getFilterKeywords();
            if ($_spamKeywords > 0) {
                $email = $this->getRequest->getParam('email');
                
                foreach ($_spamKeywords as $key => $keyword) {
                    if (str_contains($email, $keyword['tab_keywords'])) {
                        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/SpamRegistration.log');
                        $logger = new \Zend_Log();
                        $logger->addWriter($writer);
                        $logger->info(" ================ Newsletter ============= ");
                        $logger->info(print_r($this->getRequest->getParams(), true));

                        $this->getRequest->setPostValue('email', 'fake-email');

                    }
                }
                return true;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }
}
