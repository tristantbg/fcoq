<?php snippet('header') ?>


<div id="page-content" class="index">

	<div id="index-hover">
		<?php foreach ($projects as $key => $p): ?>

			<?php if($featured = $p->featured()->toFile()): ?>
				<img 
				class="lazyload lazypreload" 
				data-src="<?= $featured->thumb(array('width' => 1300))->url() ?>" 
				data-id="<?= $p->uid() ?>" 
				width="100%">
			<?php endif ?>

		<?php endforeach ?>
	</div>
	
	<?php snippet("sidebar", array("commissionedProjects" => $commissionedProjects, "personalProjects" => $personalProjects)) ?>

	<div id="bottom-link">
		<a href="<?= $site->url() ?>" data-target="index">
			Overview
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