<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $feedbacks as $feedback )
		@include('content.feedbacks._elements.card', [
			'feedback' => $feedback
		])
	@endforeach
</div>