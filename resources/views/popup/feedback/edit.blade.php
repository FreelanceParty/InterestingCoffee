@php
	use App\ValuesObject\Constants\InfoType;
@endphp
<div class="flex flex-col gap-2">
	<div class="flex flex-col gap-2">
		<label class="flex flex-col gap-2 text-sm">
			Відгук:
			<textarea name="description" rows="4" class="js-question-text px-2 w-full border-2 border-gray-200 rounded-lg text-lg resize-none">{{ $feedback->getText() }}</textarea>
		</label>
	</div>
	<button class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto disabled:bg-gray-300">Зберегти</button>
</div>
<script>
	$(document).ready(function () {
		const
			$popup = $("#popup"),
			$newText = $popup.find(".js-question-text"),
			$submitBtn = $popup.find(".js-submit")
		;

		$submitBtn.on("click", function () {
			sendRequest(
				'{{ route('action.feedback.edit')}}',
				{
					id:   '{{ $feedback->getId() }}',
					text: $newText.val()
				},
				(response) => {
					if (response.ack === "success") {
						popup.showInfo("Відгук змінено!", '{{ InfoType::SUCCESS }}');
					} else if (response.ack === "fail") {
						popup.showInfo("Помилка", '{{ InfoType::ERROR }}');
					}
				}
			);
		});
	});
</script>