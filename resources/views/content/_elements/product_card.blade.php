<div id="{{ $productType }}-{{ $id }}"
		class="js-product-card flex flex-col min-w-28 w-80 h-[400px] border-2 border-gray-300 rounded-lg shadow-xl transition duration-200 ease-in-out hover:scale-105 hover:shadow-2xl cursor-pointer">
	<div class="flex h-2/3 items-center justify-center border-b-2 border-gray-300">
		<img class="w-20 h-20" src="{{ $image }}" alt=''>
	</div>
	<div class="flex gap-2 h-1/3 justify-center text-center bg-amber-100 rounded-b-lg">
		<div class="flex flex-col gap-2">
			<div>
				{{ $title }}
			</div>
			<div>
				{{ $price }}
			</div>
		</div>
		<div class="flex flex-col gap-2">
			<div class="js-edit w-5 h-5 flex justify-center items-center bg-blue-500 rounded-xl">
				Edit
			</div>
			<div class="js-delete w-5 h-5 flex justify-center items-center bg-blue-500 rounded-xl">
				Delete
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		const
			$productCard = $('#{{ $productType }}-{{ $id }}'),
			$editButton = $productCard.find(".js-edit"),
			$deleteButton = $productCard.find(".js-delete")
		;

		$deleteButton.on("click", function () {
			popup.show(
				'{{ route('popup.product.delete') }}',
				{
					product_id:   '{{ $id }}',
					product_type: '{{ $productType }}'
				}
			);
		});
	});
</script>