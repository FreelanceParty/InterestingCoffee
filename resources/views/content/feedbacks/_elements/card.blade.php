<div id="feedback-card-{{ $feedback->getId() }}" class="flex flex-col w-64 lg:w-96 gap-6 border rounded-lg justify-between p-2 bg-amber-100 shadow-lg hover:shadow-xl">
	<div class="flex flex-col gap-1">
		<div class="flex gap-1 ml-auto">
			@if( $authUser !== NULL )
				@if( $authUser->getId() === $feedback->getUserId() )
					<i data-route="{{ route('popup.feedback.edit') }}"
							class="js-feedback-action fa-sharp fa-solid fa-pencil fa-xl cursor-pointer py-2.5 hover:text-blue-600 transition duration-200 ease-in-out hover:scale-105"></i>
				@endif
				@if( $authUser->isAdmin() || $authUser->getId() === $feedback->getUserId())
					<i data-route="{{ route('popup.feedback.delete') }}"
							class="js-feedback-action fa-sharp fa-solid fa-window-close fa-xl cursor-pointer py-2.5 hover:text-red-600 transition duration-200 ease-in-out hover:scale-105"></i>
				@endif
			@endif
		</div>
		<div>
			{{ $feedback->getText() }}
		</div>
	</div>
	<div class="flex justify-between w-full border-t border-gray-300">
		<div class="truncate">
			{{ $feedback->getUserName() }}
		</div>
		<div>
			{{ $feedback->getCreatedAt()->format('m.d.Y'), }}
		</div>
	</div>
</div>
@if( $authUser !== NULL)
	<script>
		$(document).ready(function () {
			const
				$feedbackCard = $('#feedback-card-{{ $feedback->getId() }}'),
				$actionBtn = $feedbackCard.find(".js-feedback-action")
			;

			$actionBtn.on("click", function () {
				popup.show(
					$(this).data("route"),
					{
						feedback_id: '{{ $feedback->getId() }}'
					}
				);
			});
		});
	</script>
@endif

