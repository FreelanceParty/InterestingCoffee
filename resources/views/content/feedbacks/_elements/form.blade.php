@php
	use Illuminate\Support\Facades\Auth;
	use App\Models\User;
	use App\ValuesObject\Constants\InfoType;

	/*** @var User $authUser */
	$authUser = Auth::user();
@endphp
<div class="js-feedback-field flex flex-col p-4 rounded-lg gap-2">
	<textarea placeholder="Напишіть відгук :)" class="rounded-lg border-2 border-gray-300 p-1"></textarea>
	<div class="flex justify-between">
		@if( $authUser === NULL )
			<input type="text" placeholder="Ваше ім'я" class="js-user-name-input rounded-lg border-2 border-gray-300 p-1">
		@endif
		<button data-route="{{ route('action.feedback.send') }}" class="bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto">Надіслати</button>
	</div>
</div>
<script>
	$(document).ready(function () {
		const
			$feedbackField = $(".js-feedback-field"),
			$textInput = $feedbackField.find("textarea"),
			$userNameInput = $feedbackField.find(".js-user-name-input"),
			$submitBtn = $feedbackField.find("button")
		;
		$submitBtn.on("click", function () {
			sendRequest(
				$(this).data("route"),
				{
					@if( $authUser === NULL ) user_name: $userNameInput.val(), @endif
					text:                                $textInput.val()
				},
				() => {
					popup.showInfo("Відгук надіслано!", '{{ InfoType::SUCCESS }}');
					$textInput.val("");
					$userNameInput.val("");
				}
			);
		});
	});
</script>