<?php

return function ($site, $pages, $page) {
	$projects = $page->children()->visible();
	if ($filter = param("filter")) {
		$projects = $projects->filterBy('category', $filter);
	}
	$commissionedProjects = $site->index()->visible()->filterBy('category', 'commissioned');
	$personalProjects = $site->index()->visible()->filterBy('category', 'personal');
	$title = $page->title()->html();

	return array(
	'bodyClass' => 'projects',
	'projects' => $projects,
	'commissionedProjects' => $commissionedProjects,
	'personalProjects' => $personalProjects,
	'title' => $title
	);
}

?>
