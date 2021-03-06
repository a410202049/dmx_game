<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Router extends CI_Router {

	protected function _set_default_controller()
	{
		if (empty($this->default_controller))
		{
			show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
		}

		// Is the method being specified?
		if (sscanf(ltrim(strstr($this->default_controller,'@')?:$this->default_controller,'@'), '%[^/]/%s', $class, $method))
		{
			$this->directory = rtrim(strstr($this->default_controller,'@',true)?:$this->directory,'@').'/';
			$method = $method ? $method : 'index';
		}

		if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php'))
		{
			// This will trigger 404 later
			return;
		}

		$this->set_class($class);
		$this->set_method($method);

		// Assign routed segments, index starting from 1
		$this->uri->rsegments = array(
			1 => $class,
			2 => $method
		);

		log_message('debug', 'No URI present. Default controller set.');
	}



}
