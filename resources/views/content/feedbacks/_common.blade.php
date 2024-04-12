<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $feedbacks as $feedback )
		@include('content.feedbacks._elements.card', [
			'user_name' => $feedback->getUserName(),
			'text' => $feedback->getText(),
			'created_at' => $feedback->getCreatedAt()->format('m.d.Y'),
		])
	@endforeach
</div>