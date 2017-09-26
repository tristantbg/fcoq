<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passé
?>

<?php snippet('header') ?>

<div id="page-content" class="projects">
	
	<?php snippet("sidebar", array("commissionedProjects" => $commissionedProjects, "personalProjects" => $personalProjects)) ?>
	
	<div id="sidebar-hover"></div>

	<div id="projects-grid">
		<?php foreach ($projects as $key => $project): ?>
		
			<?php if($project->featured()->isNotEmpty()): ?>
		
			<?php $featured = $project->featured()->toFile() ?>
		
				<div class="project-item <?= $project->size() ?> <?= "ml-".$project->marginLeft() ?> <?= "mr-".$project->marginRight() ?> <?= $project->category() ?>">

				<a 
				class="project-thumb" 
				href="<?= $project->url() ?>" 
				data-id="<?= $project->uid() ?>" 
				data-color="<?= $featured->color0() ?>" 
				data-target="project">
		
					<div class="project-image" style="background: <?= $featured->color0() ?>" >
						<img 
						class="lazyimg lazyload" 
						src="<?= $featured->thumb(array('width' => 200))->url() ?>" 
						data-src="<?= $featured->thumb(array('width' => 1300))->url() ?>" 
						alt="<?= $project->title()->html().' - © '.$site->title()->html() ?>" 
						width="100%" height="auto" />
					</div>

					<div class="project-title">
						<?= $project->title()->html(); e($project->subtitle()->isNotEmpty(), ", ".$project->subtitle()->html()) ?>
					</div>
		
				</a>
					
				</div>
		
			<?php endif ?>
		
		<?php endforeach ?>
	</div>

	<div id="bottom-link">
		<a href="<?= page('index')->url() ?>" data-target="page">
			Index
		</a>
	</div>
	
	<?php if($about = $site->aboutpage()->toPage()): ?>
	<div id="title-bottom">
		<a href="<?= $about->url() ?>" data-target="page">
			<?= $about->title()->html() ?>
		</a>
	</div>
	<?php endif ?>

</div>

<?php snippet('footer') ?>