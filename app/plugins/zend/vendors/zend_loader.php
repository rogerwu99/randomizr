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
 * Ensures that the vendors folder is in the include path, for Zends's
 * internal require_once calls. This assumes that the Zend Framework
 * has been placed in the vendors directory, if you are short on disc
 * or don't feel the need to add the entire framework, I have listed
 * the minimum folders/files required for the plugin to work.
 * 
 * /cake/app/vendors/Zend/Amf/...
 * /cake/app/vendors/Zend/Date/...
 * /cake/app/vendors/Zend/Loader/...
 * /cake/app/vendors/Zend/Server/...
 * /cake/app/vendors/Zend/Date.php
 * /cake/app/vendors/Zend/Exception.php
 * /cake/app/vendors/Zend/Loader.php
 * /cake/app/vendors/Zend/Version.php
 */
$vendorPath = APP.'vendors';
$currentIncludePath = ini_get('include_path');
$currentIncludes = explode(PATH_SEPARATOR, $currentIncludePath);

/**
 * Check if the vendor path has not already been added and that we
 * have access to the ini_set method.
 */
if (!in_array($vendorPath, $currentIncludes) && function_exists('ini_set'))
{
        $currentIncludes[] = $vendorPath;
        ini_set('include_path', implode(PATH_SEPARATOR, $currentIncludes));
}

/**
 * It's not the prettiest way of importing but seems to work fine. Here
 * we import Zend's Autoloader and register it which should handle the
 * require_once calls as needed.
 */
App::import('Vendor', 'Autoloader', array('file' => 'Zend'.DS.'Loader'.DS.'Autoloader.php'));
Zend_Loader_Autoloader::getInstance();
?>