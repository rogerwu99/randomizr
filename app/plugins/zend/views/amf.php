<?php
/*************************************************************************************************************
 * This work is licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported
 * that is bundled with this package in the file LICENSE. It is also available through
 * the world-wide-web at this URL: http://creativecommons.org/licenses/by-sa/3.0/legalcode
 * Copyright (c) 2008-2009, Ontic (http://www.ontic.com.au). All rights reserved.
 * Redistributions of files must retain the above copyright notice.
 * 
 * @id             $Id$
 * @license        see LICENSE
 * @author         see AUTHORS
 * @copyright      see COPYRIGHT
 * @package        zend
 * @subpackage     views
 * @since          Zamf v 1.0.0.1
 * @version        $Revision$
 * @modifiedby     $LastChangedBy$
 * @lastmodified   $Date$
 * @filesource     $HeadURL$
 ************************************************************************************************************/
class AmfView extends View
{
        /**
         * Storage for the controller data.
         * @var array
         */
        public $viewVars = array();
        
        /**
         * Constructor.
         * @param object $controller
         * @return View
         */
        public function __construct($controller)
        {
                if (is_object($controller))
                {
                        $this->viewVars = $controller->viewVars['Amfvar'];
                }
        }
        
        /**
         * Renders view for given action and layout. In this case the view
         * is our Flash application and we simply need to serialize the data
         * and send it back to the client.
         * @param string $action
         * @param string $layout
         * @param string $file
         * @return void
         */
        public function render($action = null, $layout = null, $file = null)
        {
                if (!empty($this->validationErrors))
                {
                        $this->viewVars['ValidationErrors'] = $this->validationErrors;
                }
                
                $dispatcher = AmfDispatcher::getInstance();
                $encoding = $dispatcher->request->getObjectEncoding();
                $messageBody = new Zend_Amf_Value_MessageBody('/1/onResult', null, $this->viewVars);
                $response = new Zend_Amf_Response_Http();
                $response->setObjectEncoding($encoding);
                $response->addAmfBody($messageBody);
                $response->finalize();
                
                echo $response->getResponse();
        }
}
?>