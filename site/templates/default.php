<?php snippet('header') ?>

<div id="page-content" class="default">
	
	<div id="title-bottom">
		<?= $page->title()->html() ?>
	</div>

	<?= $page->text()->kt() ?>

	<div id="bottom-link">
		<a href="<?= $site->url() ?>" data-target="index">
			Back
		</a>
	</div>
</div>

<?php snippet('footer') ?>