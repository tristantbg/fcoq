<?php snippet('header') ?>

<div id="page-content" class="project <?= $page->category() ?>">
	
	<div class="slider">
	
	<div id="sidebar" 
	<?php if($featured = $page->featured()->toFile()): ?>
	style="color: <?= $featured->color0() ?>;"
	<?php endif ?>
	>
		<div class="category">
			<div class="category-title">
				<?= ucfirst($page->category()) ?>
			</div>
			<div class="category-item">
				<div class="index">
					<?= str_pad($categoryIndex, 2, '0', STR_PAD_LEFT).'.'; ?>
				</div>
				<div class="title">
					<div>
						<?= $title ?>
					</div>
					<?php if($subtitle):?>
						<div>
							<?= $subtitle ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	$idx = 0;
	$duo = false;
	$count = $images->count();
	?>

	<?php foreach ($images as $key => $image): ?>
		
		<?php if(!$duo): ?>

		<?php $image = $image->toFile(); ?>

		<div class="slide" 
		<?php if($image->caption()->isNotEmpty()): ?>
		data-caption="<?= $image->caption()->kt()->escape() ?>"
		<?php endif ?>
		>
		
		<?php if($image->videofile()->isNotEmpty() or $image->videolink()->isNotEmpty() or $image->videoexternal()->isNotEmpty()): ?>
			<div class="content video">
				<?php 
				$poster = $image->thumb(array('width' => 1500))->url();
				if ($image->videoexternal()->isNotEmpty()) {
					echo '<video class="js-player" poster="'.$poster.'" width="100%" height="100%" controls="false" loop><source src=' . $image->videoexternal() . ' type="video/mp4"></video>';
				}
				else if ($image->videofile()->isNotEmpty()) {
					echo '<video class="js-player" poster="'.$poster.'" width="100%" height="100%" controls="false" loop><source src=' . $image->videofile()->toFile()->url() . ' type="video/mp4"></video>';
				} else {
					$url = $image->videolink();
					// $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $url);
					// if(is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false) {
					// // is youtube
					// 	$videoID = $url;
					// 	echo '<div class="js-player" data-type="youtube" data-video-id="' . $videoID  . '"></div>';
					// } else {
					// // should be vimeo
					// 	$videoID = $url;
					// 	echo '<div class="js-player" data-type="vimeo" data-video-id="' . $videoID  . '"></div>';
					// }
					if ($image->vendor() == "youtube") {
						echo '<div class="js-player" data-type="youtube" data-video-id="' . $url  . '"></div>';
					} else {
						echo '<div class="js-player" data-type="vimeo" data-video-id="' . $url  . '"></div>';
					}
				}
				?>
			</div>
		<?php else: ?>
			<div class="content<?php e($image->duo()->bool(), ' duo') ?>">
				<img class="lazyimg" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-flickity-lazyload="<?= $image->thumb(array('height' => 1500))->url() ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<noscript>
					<img src="<?= $image->thumb(array('height' => 1500))->url() ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
				<?php if($image->duo()->bool()): ?>
					<?php $imageduo = $images->get($idx+1)->toFile() ?>
					<?php if($imageduo): ?>
					<?php $duo = true ?>
					<img class="lazyimg" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-flickity-lazyload="<?= $imageduo->thumb(array('height' => 1500))->url() ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
					<noscript>
						<img src="<?= $imageduo->thumb(array('height' => 1500))->url() ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
					</noscript>
					<?php $count-- ?>
					<?php endif ?>
				<?php endif ?>
				
			</div>
		<?php endif ?>

		</div>

		<?php else: ?>
		<?php $duo = false ?>
		<?php endif ?>

	<?php $idx++ ?>
	<?php endforeach ?>

	<div id="slide-number">
		<?= "1 — ".$count ?>
	</div>

	<div id="bottom-link">
		<a href="<?= $site->url() ?>" data-target="index">
			Back
		</a>
	</div>

	</div>


</div>

<?php snippet('footer') ?>