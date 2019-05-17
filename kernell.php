<?php
if(! defined("ABSPATH") ) {
  exit;
}
class kernell {
  public function __construct() {
    add_action("homepage",array($this,'exam'));
  }
  function exam() {
		include_once("query-builder.php");
		$products=new WCQueryBuilder();
		$val =array();
		$color =array(
			'taxonomy' 		=> 'pa_color',
			'terms' 		=> array('yellow','blue'),
			'field' 		=> 'slug',
			'operator' 		=> 'IN'
		);
		$size =array(
			'taxonomy' 		=> 'pa_size',
			'terms' 		=> array('20'),
			'field' 		=> 'slug',
			'operator' 		=> 'OR'
		);
		array_push($val,$color);
		array_push($val,$size);
		echo $products->query_factory($val);
  }
}
new kernell();