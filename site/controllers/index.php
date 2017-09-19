<?php

return function ($site, $pages, $page) {
	$projects = $site->index()->visible()->filterBy('template', 'project');
	$commissionedProjects = $site->index()->visible()->filterBy('category', 'commissioned');
	$personalProjects = $site->index()->visible()->filterBy('category', 'personal');
	$title = $page->title()->html();

	return array(
	'bodyClass' => 'index',
	'projects' => $projects,
	'commissionedProjects' => $commissionedProjects,
	'personalProjects' => $personalProjects,
	'title' => $title
	);
}

?>
