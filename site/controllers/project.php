<?php

return function ($site, $pages, $page) {
	$title = $page->title()->html();
	if ($page->subtitle()->isNotEmpty()) {
		$subtitle = $page->subtitle();
	} else {
		$subtitle = false;
	}

	$visible = site()->index()->visible();
	$commissionedProjects = $visible->filterBy('category', 'commissioned');
	$personalProjects = $visible->filterBy('category', 'personal');
	$categoryIndex = 0;

	foreach ([$commissionedProjects, $personalProjects] as $key => $categoryItems) {
		$idx = 1;
		foreach ($categoryItems as $key => $item) {
			if ($page->is($item)) { 
				$categoryIndex = $idx;
				break;
			}
			$idx++;
		}
	}
	

	return array(
	'categories' => c::get('site-categories'),
	'bodyClass' => 'project',
	'title' => $title,
	'subtitle' => $subtitle,
	'categoryIndex' => $categoryIndex,
	'images' => $page->medias()->toStructure()
	);
}

?>
