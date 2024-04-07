@php
	use App\ValuesObject\InfoType;
@endphp
<div class="flex flex-col gap-2">
	<div class="p-2">
		Ви дійсно хочете видалити "{{ $productName }}"?
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
				'{{ route('action.product.delete') }}',
				{
					product_id:   '{{ $id }}',
					product_type: '{{ $productType }}'
				},
				() => {
					$('#{{ $productType }}-{{ $id }}').remove();
					popup.showInfo("Продукт видалено!", '{{ InfoType::SUCCESS }}');
				}
			);
		});
	});
</script>