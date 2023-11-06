<?php
namespace Y2B\StopSpamRegistration\Plugin;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\RequestInterface;
use Y2B\StopSpamRegistration\Helper\Data as DataHelper;

class CheckspamCustomerRegistration
{

    public function __construct(
        ResultFactory $Redirect,
        ManagerInterface $messageManager,
        RequestInterface $request,
        DataHelper $helper
    )
    {
        $this->resultFactory = $Redirect;
        $this->_messageManager = $messageManager;
        $this->getRequest = $request;
        $this->helper = $helper;
    }

    public function beforeExecute(\Magento\Customer\Controller\Account\CreatePost $subject) {

        $_enable = $this->helper->getEnable();
        $_enableNewsletter = $this->helper->getNewsletterRegistrationEnable();
        if ($_enable && $_enableNewsletter) {
            $_spamKeywords = $this->helper->getFilterKeywords();

            if ($_spamKeywords > 0) {
                $firstname = $this->getRequest->getParam('firstname');
                $lastname = $this->getRequest->getParam('lastname'); 
                $email = $this->getRequest->getParam('email'); 
                
                foreach ($_spamKeywords as $key => $keyword)
                {
                    if ( (str_contains($firstname, $keyword['tab_keywords'])) || 
                        (str_contains($lastname, $keyword['tab_keywords'])) ||
                        (str_contains($email, $keyword['tab_keywords'])) )
                    {
                        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/SpamRegistration.log');
                        $logger = new \Zend_Log();
                        $logger->addWriter($writer);

                        $logger->info(" ================ Customer Registration ============= ");
                        $logger->info(print_r($this->getRequest->getParams(), true));

                        $this->getRequest->setParam('email','fake-email'); // to stop registration.

                        return $subject;
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