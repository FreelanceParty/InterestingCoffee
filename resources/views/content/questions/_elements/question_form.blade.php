@php
	use Illuminate\Support\Facades\Auth;
	use App\Models\User;
	use App\ValuesObject\Constants\InfoType;

	/*** @var User $authUser */
	$authUser = Auth::user();
@endphp
<div class="js-question-form flex flex-col p-4 rounded-lg gap-2">
	<textarea placeholder="Задайте питання" class="rounded-lg border-2 border-gray-300 p-1"></textarea>
	<button data-route="{{ route('action.question.send') }}" class="bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto">Надіслати</button>
</div>
<script>
	$(document).ready(function () {
		const
			$questionForm = $(".js-question-form"),
			$textInput = $questionForm.find("textarea"),
			$submitBtn = $questionForm.find("button")
		;
		$submitBtn.on("click", function () {
			sendRequest(
				$(this).data("route"),
				{
					user_id: '{{ $authUser->getId() }}',
					text:    $textInput.val()
				},
				() => {
					popup.showInfo("Питання надіслано!", '{{ InfoType::SUCCESS }}');
					$textInput.val("");
				}
			);
		});
	});
</script>