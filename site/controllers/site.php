<?php

return function ($site, $pages, $page) {
	$pTemplate = $page->intendedTemplate();
	$bodyClass = $pTemplate;
	if($bodyClass == 'home') $bodyClass = 'projects';
	
	return array(
	'bodyClass' => $bodyClass,
	'categories' => c::get('site-categories')
	);
}

?>
