<div id="js-feedback-block" class="w-full flex flex-col gap-2 rounded-lg p-2">
	<div class="flex justify-center">
		<h1 class="text-red-500">Відгуки наших дорогих відвідувачів :)</h1>
	</div>
	<div class="w-full flex flex-wrap justify-center gap-4">
		@foreach( $feedbacks as $feedback )
			@include('content.feedbacks._elements.card', [
				'user_name' => $feedback->getUserName(),
				'text' => $feedback->getText(),
				'created_at' => $feedback->getCreatedAt()->format('d.m.Y'),
			])
		@endforeach
	</div>
	<div class="flex justify-center">
		<button data-route="{{ route('content.feedbacks') }}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl">Більше</button>
	</div>
</div>
<script>
	$(document).ready(function () {
		const
			$feedbackBlock = $("#js-feedback-block"),
			$seeMore = $feedbackBlock.find(".js-see-more")
		;

		$seeMore.on("click", function () {
			changeMenu($(this).attr("data-route"));
		});
	});
</script>