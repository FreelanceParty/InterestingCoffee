@php
	use App\ValuesObject\Constants\InfoType;
@endphp
<div class="flex flex-col gap-2">
	<div class="p-2">
		Ви дійсно хочете видалити це замовлення?
	</div>
	<button class="js-submit bg-red-500 text-white px-3 py-1 rounded-xl ml-auto">Так, видалити</button>
</div>
<script>
	$(document).ready(function () {
		const
			$popup = $("#popup"),
			$submitButton = $popup.find(".js-submit")
		;

		$submitButton.on("click", function () {
			sendRequest(
				'{{ route('action.order.delete') }}',
				{
					order_id: '{{ $id }}'
				},
				() => {
					$('#order-card-{{ $id }}').remove();
					popup.showInfo("Замовлення видалено!", '{{ InfoType::SUCCESS }}');
				}
			);
		});
	});
</script>