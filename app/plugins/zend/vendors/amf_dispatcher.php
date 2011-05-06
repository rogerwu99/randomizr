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
 * @subpackage     vendors
 * @since          Zamf v 1.0.0.1
 * @version        $Revision$
 * @modifiedby     $LastChangedBy$
 * @lastmodified   $Date$
 * @filesource     $HeadURL$
 ************************************************************************************************************/

/**
 * Loads the required Zend files from the vendors folder.
 */
require_once 'zend_loader.php';

class AmfDispatcher extends Object
{
        /**
         * Stores a single instance of this class.
         * @var AmfDispatcher
         */
        protected static $_instance = null;
        
        /**
         * Determines whether were dealing with AMF data.
         * @var boolean
         */
        public $active = false;
        
        /**
         * Storage for the request bodies.
         * @var array
         */
        public $bodies = array();
        
        /**
         * Storage for the request message.
         * @var Zend_Amf_Value_MessageBody
         */
        public $message = null;
        
        /**
         * Storage for the request data.
         * @var Zend_Amf_Request_Http
         */
        public $request = null;
        
        /**
         * Stores an instance of the server (aka gateway).
         * @var Zend_Amf_Server
         */
        public $server = null;
        
        /**
         * Dispatches a given URL, typically this will point to a method
         * within your controller. Some validation is carried out on the
         * URL so you can either use a decimal or forward slash as the
         * deliminator seperating the controller and method. Both examples
         * are valid. /controller/method or controller.method
         * @param string $target
         * @return boolean
         */
        protected function _dispatch($target)
        {
                if ($target !== 'null' && $target !== 'createStream')
                {
                        $url = $target;
                        
                        if (strpos($target, '/') === false)
                        {
                                $target = explode('.', $target);
                                $target[0] = Inflector::underscore($target[0]);
                                $url = join('/',  $target);
                        }
                        
                        $Dispatcher = new Dispatcher();
                        $Dispatcher->dispatch($url);
                }
                else
                {
                        trigger_error('AmfDispatcher could not dispatch URL: '.$target);
                }
                
                return true;
        }
        
        /**
         * Creates a new Zend_Amf_Request_Http instance for storing the
         * request URL and data. The data is deserialized internally within
         * the Zend_Amf_Request_Http class, very little needs to be done here.
         * @return void
         */
        public static function forwardRequest()
        {
                $dispatcher = AmfDispatcher::getInstance();
                $dispatcher->active = true;
                $dispatcher->request = new Zend_Amf_Request_Http();
                $dispatcher->bodies = $dispatcher->request->getAmfBodies();
                
                foreach ($dispatcher->bodies as $body)
                {
                        $dispatcher->message = $body;
                        $dispatcher->_dispatch($body->getTargetUri());
                }
                
                exit();
        }
        
        /**
         * Returns the message data sent with the request.
         * @return unknown_type
         */
        public static function getData()
        {
                $dispatcher = AmfDispatcher::getInstance();
                return $dispatcher->message->getData();
        }
        
        /**
         * Validates a new singleton class instance to determine if the
         * class has previously been instantiated, if so, the same instance
         * is returned, otherwise a new instance is created.
         * @return AmfDispatcher
         */
        public static function getInstance()
        {
                if (self::$_instance === null)
                {
                        self::$_instance = new self();
                        self::$_instance->server = new Zend_Amf_Server();
                }
                
                return self::$_instance;
        }
        
        /**
         * Returns true, only when a request containing AMF data
         * is successfully forwarded.
         * @return boolean
         */
        public static function isActive()
        {
                $dispatcher = AmfDispatcher::getInstance();
                return $dispatcher->active;
        }
}

/**
 * Check the page content type and determine whether the request
 * contains AMF data in a binary format, if it does we can forward
 * the request and begin deserializing the data.
 */
$request = env('CONTENT_TYPE');

if ($request == 'application/x-amf')
{
        if (class_exists('Debugger'))
        {
                Debugger::output('txt');
        }
        
        if (AmfDispatcher::forwardRequest() === false)
        {
                trigger_error("Unable to forward AMF request");
                exit();
        }
        exit();
}
?>