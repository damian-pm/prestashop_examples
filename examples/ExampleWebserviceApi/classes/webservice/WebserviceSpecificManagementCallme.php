<?php

class WebserviceSpecificManagementCallme implements WebserviceSpecificManagementInterface {
    
    /** @var WebserviceOutputBuilder $webServiceBuilder */
    protected $webServiceBuilder;
    protected $output;
    /** @var WebserviceRequest $wsObject */
    protected $wsObject;

    public function setUrlSegment($segments) {

    $this->urlSegment = $segments;
        return $this;
    }
    public function getUrlSegment(){
        return $this->urlSegment;
    }
    public function getWsObject()
    {
        return $this->wsObject;
    }
    public function getObjectOutput()
    {
        return $this->webServiceBuilder;
    }
    /**
    * This must be return a string with specific values as WebserviceRequest expects.
    *
    * @return string
    */
    public function getContent()
    {
        return $this->webServiceBuilder->getObjectRender()->overrideContent($this->output);
    }

    public function setWsObject(WebserviceRequestCore $webserviceRequestCore)
    {
        $this->wsObject = $webserviceRequestCore;
        return $this;
    }
    /**
    * @param WebserviceOutputBuilderCore $obj
    * @return WebserviceSpecificManagementInterface
    */
    public function setObjectOutput(WebserviceOutputBuilderCore $webServiceBuilder){
        $this->webServiceBuilder = $webServiceBuilder;
        return $this;
    }

    public function manage() {
        
        $objects_products           = array();
        $objects_products['empty']  = new Customer();
        $customerList               = Customer::getCustomers();

        foreach ($customerList as $customer) {
            $objects_products[] = new Customer($customer['id_customer']);
        }

        $this->_resourceConfiguration = $objects_products['empty']->getWebserviceParameters();
        
        $fieldsToDisplay  = 'full'; // 'minimum', 'full'
        $schema           = ''; // 'synopsis' - show customer column details, 'blank', null
        $deep             = 0; // depth for the tree diagram output
        $viewList         = WebserviceOutputBuilder::VIEW_LIST; //  ::VIEW_LIST , ::VIEW_DETAILS
        $override         = false;

        $this->output    .= $this->webServiceBuilder->getContent($objects_products, $schema, $fieldsToDisplay, $deep, $viewList, $override);
    }
}