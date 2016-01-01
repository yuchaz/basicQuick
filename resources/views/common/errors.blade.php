@if (count($errors) > 0)
	<!-- Form Error List -->
	<div class="alert alert-danger fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Oops! Something went wrong. 
		<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif 
