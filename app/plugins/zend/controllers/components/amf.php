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
 * @subpackage     controllers.components
 * @since          Zamf v 1.0.0.1
 * @version        $Revision$
 * @modifiedby     $LastChangedBy$
 * @lastmodified   $Date$
 * @filesource     $HeadURL$
 ************************************************************************************************************/
class AmfComponent extends Object
{
        /**
         * Auto redirecting is not enabled by default.
         * @var boolean
         */
        public $autoRedirect = false;
        
        /**
         * Import the components we need.
         * @var array
         */
        public $components = array('Session');
        
        /**
         * Called before the Controller::beforeFilter(). We simply check if
         * the request contains AMF data and pass that data to the controller.
         * Other wise we just dismiss everything and let Cake do its thing.
         * @param object $controller
         * @return void
         */
        public function initialize($controller)
        {
                $controller->isAmf = false;
                
                if (class_exists('AmfDispatcher') && AmfDispatcher::isActive())
                {
                        $controller->isAmf = true;
                        $controller->disableCache();
                        $controller->view = 'Zend.Amf';
                        $data = AmfDispatcher::getData();
                        
                        if (!empty($data))
                        {
                                if (is_object($data))
                                {
                                        $controller->data = Set::reverse($data);
                                }
                                else if (Set::countDim($data) == 1)
                                {
                                        $controller->data = array_pop($data);
                                }
                                else
                                {
                                        $controller->data = $data;
                                }
                        }
                }
        }
        
        /**
         * Called before Controller::redirect(). Note that redirecting is
         * not enabled by default, you should set the autoRedirect property
         * to true within your controller if you neeed to use it.
         * @param object $controller
         * @param mixed $url
         * @param object $status
         * @param boolean $exit
         * @return void
         */
        public function beforeRedirect($controller, $url, $status = null, $exit = true)
        {
                if ($controller->isAmf && $this->autoRedirect)
                {
                        if (is_array($url))
                        {
                                $url = Router::url($url);
                        }
                        
                        $Dispatcher = new Dispatcher();
                        $Dispatcher->dispatch($url);
                        
                        if ($exit)
                        {
                                exit();
                        }
                }
        }
        
        /**
         * Called after the Controller::beforeRender(), after the view class
         * is loaded, and before the Controller::render(). Assuming the request
         * came from Flash and contains AMF data, we grab any data set in the
         * controller and place it in a variable so the view can access it.
         * @param object $controller
         * @return void
         */
        public function beforeRender($controller)
        {
                if ($controller->isAmf)
                {
                        Configure::write('debug', 0);
                        
                        foreach ($controller->viewVars as $key => $value)
                        {
                                unset($controller->viewVars[$key]);
                                $controller->viewVars[Inflector::camelize($key)] = $value;
                        }
                        
                        $flash = $this->Session->read('Message.flash');
                        
                        if (!empty($flash))
                        {
                                $controller->viewVars['Message'] = $flash['message'];
                        }
                        
                        if (empty($this->status))
                        {
                                $controller->viewVars['Status'] = $this->action;
                        }
                        else
                        {
                                $controller->viewVars['Status'] = $this->status;
                        }
                }
        }
}
?>