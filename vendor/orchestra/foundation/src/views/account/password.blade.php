@extends('orchestra/foundation::layout.main')

@section('content')

<div class="row">

	<div class="eight columns rounded box">
		<?php echo $form; ?>
	</div>

	<div class="four columns">
		@placeholder('orchestra.account')
		@placeholder('orchestra.helps')
	</div>

</div>

@stop
