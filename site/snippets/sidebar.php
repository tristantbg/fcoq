<div id="sidebar">
	<?php foreach (["Personal" => $personalProjects, "Commissioned" => $commissionedProjects] as $c => $categoryProjects): ?>
		<div class="category">
			<div class="category-title">
				<a href="<?= $site->url()."/filter:".lcfirst($c) ?>">
					<?= $c ?>
				</a>
			</div>
			<?php $idx = 1 ?>
			<?php foreach ($categoryProjects as $key => $p): ?>
				<a href="<?= $p->url() ?>" 
					class="project" 
					data-target="project" 
					data-id="<?= $p->uid() ?>" 
					<?php if($featured = $p->featured()->toFile()): ?>
					data-color="<?= $featured->color0() ?>"
					<?php endif ?>
					>
					<div class="category-item">
							<div class="index">
								<?= str_pad($idx, 2, '0', STR_PAD_LEFT).'.'; ?>
							</div>
							<div class="title">
								<?= $p->title()->html() ?>
							</div>
					</div>
				</a>
				<?php $idx++ ?>
			<?php endforeach ?>
		</div>
	<?php endforeach ?>
</div>