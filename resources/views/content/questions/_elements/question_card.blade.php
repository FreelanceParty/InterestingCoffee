@php
	use App\ValuesObject\InfoType;
@endphp
<div data-id="{{ $id }}" id="question-card-{{ $id }}" class="js-question-card flex flex-col rounded-xl p-2 gap-2 bg-gray-200 border-2 border-gray-400">
	<div>{{ $question }}</div>
	<div class="flex justify-between gap-2 items-center">
		<div>{{ $userEmail }}</div>
		<div class="ml-auto text-xs">{{ $date }}</div>
	</div>
	@if( $authUser->isAdmin() )
		<div class="flex flex-col gap-2">
			<textarea class='rounded-lg border-2 border-gray-300 p-1'></textarea>
			<button data-route="{{ route('action.reply-question') }}" class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto">Відповісти</button>
		</div>
		<script>
			$(document).ready(function () {
				const
					$content = $(".js-content"),
					$questionCard = $("#question-card-{{ $id }}"),
					$submitBtns = $questionCard.find(".js-submit")
				;
				$submitBtns.on("click", function () {
					const $currentTextArea = $questionCard.find("textarea");
					sendRequest(
						$(this).data("route"),
						{
							question_id: '{{ $id }}',
							answer:      $currentTextArea.val()
						},
						() => {
							popup.showInfo("Відповідь надіслана!", '{{ InfoType::SUCCESS }}');
							$questionCard.remove();
							if ($(".js-question-card").length === 0) {
								$content.append("<h2>Запитань поки що немає!</h2>");
							}
						}
					);
				});
			});
		</script>
	@elseif( ! empty($answer) )
		<div class="flex flex-col rounded-xl p-2 gap-2 bg-blue-200 border-2 border-blue-400">
			<div>{{ $answer }}</div>
			<div class="ml-auto text-xs">{{ $answerDate }}</div>
		</div>
	@endif
</div>