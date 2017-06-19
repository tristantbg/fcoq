<?php snippet('header') ?>

<div id="page-content" class="project">
	
	<div class="slider">

	<?php foreach ($images as $key => $image): ?>

		<?php $image = $image->toFile(); ?>

		<div class="slide" 
		<?php if($image->caption()->isNotEmpty()): ?>
		data-caption="<?= $image->caption()->kt()->escape() ?>"
		<?php endif ?>
		>
			<div class="content">
				<img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-flickity-lazyload="<?= resizeOnDemand($image, 1300, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<noscript>
					<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
			</div>
		</div>

	<?php endforeach ?>

	</div>
	
	<div id="project-description">
		<?= $page->text()->kt() ?>
	</div>

</div>

<?php snippet('footer') ?>