<?php

namespace Y2B\StopSpamRegistration\Helper;

use Magento\Framework\Serialize\SerializerInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var SerializerInterface
     */

    protected $serializer;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
        parent::__construct($context);
    }
    
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getFilterKeywords()
    {
        $keywords = $this->getConfig('stoplist/lists/keywords');
        
        if (isset($keywords)) {
            $keywords = $this->serializer->unserialize($keywords);
        }
        
        return $keywords;
    }

    public function getEnable()
    {
        return $this->getConfig('stoplist/lists/status');
    }

    public function getCustomerRegistrationEnable()
    {
        return $this->getConfig('stoplist/lists/customer_registration');
    }

    public function getNewsletterRegistrationEnable()
    {
        return $this->getConfig('stoplist/lists/newsletter_registration');
    }
}
