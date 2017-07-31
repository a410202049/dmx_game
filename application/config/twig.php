<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['twig_admin'] = array(
	'extension'=> '.twig',
	'template_dir'=> "./templates/admin/",
	'cache_dir'=> "./cache/admin",
	'debug'=>true,
	'auto_reload'=>true
);

$config['twig_home'] = array(
	'extension'=> '.twig',
	'template_dir'=> "./templates/home/",
	'cache_dir'=> "./cache/home",
	'debug'=>true,
	'auto_reload'=>true
);

/* End of file twig.php */
/* Location: ./application/config/twig.php */