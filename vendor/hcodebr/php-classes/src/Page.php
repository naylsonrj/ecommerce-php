<?php 

namespace Hcode;
include "library/Rain/Tpl.php";
use Rain\Tpl;

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];

	public function __construct($opts = array(), $tpl_dir = "/views/"){
		
		$this->options = array_merge($this->defaults, $opts);

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
	    );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");

	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}

}



	// include
	
	
	// config
	$config = array(
					"tpl_dir"       => "../../../../views",
					"cache_dir"     => "../../../../views-cache",
					"debug"         => true // set to false to improve the speed
				   );

	Tpl::configure( $config );

	// Add PathReplace plugin (necessary to load the CSS with path replace)
	require_once('library/Rain/Tpl/Plugin/PathReplace.php');
	Rain\Tpl::registerPlugin( new Rain\Tpl\Plugin\PathReplace() );

 ?>