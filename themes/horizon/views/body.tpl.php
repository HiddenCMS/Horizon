<?php
$color = function($name, $fallback){
	$value = (string)$this->config->{'horizon_'.$name};
	return preg_match('/^#[0-9a-f]{3}(?:[0-9a-f]{3})?$/i', $value) ? $value : $fallback;
};

$content_width = in_array((string)$this->config->horizon_content_width, ['1040', '1180', '1320'], TRUE)
	? (string)$this->config->horizon_content_width
	: '1180';
?>
<div class="horizon-site" style="--horizon-accent: <?php echo $color('accent_color', '#087f8b') ?>; --horizon-secondary: <?php echo $color('secondary_color', '#c96f5b') ?>; --horizon-text: <?php echo $color('text_color', '#202c36') ?>; --horizon-background: <?php echo $color('background_color', '#f4f6f5') ?>; --horizon-container: <?php echo $content_width ?>px;">
	<header class="site-header">
		<?php if ($zone = (string)$this->output->region('top')): ?>
		<div class="site-topbar"><div class="horizon-container"><?php echo $zone ?></div></div>
		<?php endif ?>

		<?php if ($zone = (string)$this->output->region('header')): ?>
		<div class="site-identity"><div class="horizon-container site-identity-inner"><?php echo $zone ?></div></div>
		<?php endif ?>

		<?php if ($zone = (string)$this->output->region('navigation')): ?>
		<nav class="site-navigation" aria-label="<?php echo $this->lang('Navigation principale') ?>">
			<div class="horizon-container">
				<button class="site-navigation-toggle" type="button" aria-expanded="false" aria-controls="horizon-navigation-content">
					<?php echo icon('fas fa-bars') ?><span><?php echo $this->lang('Menu') ?></span>
				</button>
				<div class="site-navigation-content" id="horizon-navigation-content"><?php echo $zone ?></div>
			</div>
		</nav>
		<?php endif ?>
	</header>

	<?php if ($zone = (string)$this->output->region('hero')): ?>
	<section class="site-hero"><div class="horizon-container"><?php echo $zone ?></div></section>
	<?php endif ?>

	<?php if (!empty($this->url->request) && ($breadcrumb = $this->widget('breadcrumb'))): ?>
	<div class="site-breadcrumb"><div class="horizon-container"><?php echo $breadcrumb->output() ?></div></div>
	<?php endif ?>

	<?php if ($zone = (string)$this->output->region('before_content')): ?>
	<section class="site-before-content"><div class="horizon-container"><?php echo $zone ?></div></section>
	<?php endif ?>

	<?php if (($zone = (string)$this->output->error()) || ($zone = (string)$this->output->region('content'))): ?>
	<main class="site-content"><div class="horizon-container"><?php echo $zone ?></div></main>
	<?php endif ?>

	<?php if ($zone = (string)$this->output->region('after_content')): ?>
	<section class="site-after-content"><div class="horizon-container"><?php echo $zone ?></div></section>
	<?php endif ?>

	<?php if ($zone = (string)$this->output->region('footer')): ?>
	<footer class="site-footer"><div class="horizon-container"><?php echo $zone ?></div></footer>
	<?php endif ?>
</div>
