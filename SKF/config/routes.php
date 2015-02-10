<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	Router::connect('/', array('controller' => 'public', 'action' => 'home'));
	
	Router::connect('/products-search', array('controller' => 'productssearch', 'action' => 'products_search'));   
	
	Router::connect('/applications', array('controller' => 'public', 'action' => 'applications'));
	
	Router::connect('/contact', array('controller' => 'public', 'action' => 'contact'));
	Router::connect('/'.SLUG_PRODUCT_TYPE_LINEAR.'svil', array('controller' => 'svil', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_TYPE_LINEAR.'svil')));
	Router::connect('/'.SLUG_PRODUCT_TYPE_PILLAR, array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_TYPE_PILLAR)));
	Router::connect('/'.SLUG_PRODUCT_TYPE_LINEAR, array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_TYPE_LINEAR)));
	Router::connect('/'.SLUG_PRODUCT_TYPE_ROTARY, array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_TYPE_ROTARY)));
	Router::connect('/'.SLUG_PRODUCT_TYPE_CONTROL, array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_TYPE_CONTROL)));
	Router::connect('/'.SLUG_PRODUCT_TYPE_ACCESSORY, array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_TYPE_ACCESSORY)));

	Router::connect('/'.SLUG_PRODUCT_COMPARE_SELECT .'/*', array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_COMPARE_SELECT)));
	Router::connect('/'.SLUG_PRODUCT_COMPARE_SELECT.'svil' .'/*', array('controller' => 'svil', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_COMPARE_SELECT.'svil')));
	Router::connect('/'.SLUG_PRODUCT_COMPARE_VIEW.'svil' .'/*', array('controller' => 'svil', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_COMPARE_VIEW.'svil')));
	Router::connect('/'.SLUG_PRODUCT_COMPARE_VIEW .'/*', array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_COMPARE_VIEW)));

	Router::connect('/'.SLUG_PRODUCT_ACCESSORIES .'/*', array('controller' => 'public', 'action' => str_replace ( '-', '_', SLUG_PRODUCT_ACCESSORIES)));

//	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));