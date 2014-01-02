<?php

use Illuminate\Support\Facades\Auth;
use Orchestra\Support\Facades\App; ?>

<header class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-responsive-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo handles('orchestra::/'); ?>" class="navbar-brand">
				<?php echo memorize('site.name', 'Orchestra Platform'); ?>
			</a>
		</div>
		<div class="collapse navbar-collapse main-responsive-collapse">
			@include('orchestra/foundation::layout.widgets.menu', array('menu' => App::menu('orchestra')))
			@include('orchestra/foundation::layout.widgets.usernav')
		</div>
	</div>
</header>

<?php if ( ! Auth::check()) : ?>
<script>
jQuery(function ($) {
	$('a[rel="user-menu"]').on('click', function (e) {
		e.preventDefault();

		window.location.href = "<?php echo handles('orchestra::login'); ?>";

		return false;
	});
});
</script>
<?php endif; ?>
<br>
