@php
	use App\ValuesObject\InfoType;
	use App\ValuesObject\ProductType;
@endphp
<div class="flex flex-col gap-2 text-sm">
	<div class="flex gap-2">
		<div class="flex flex-col w-1/2 gap-2">
			<label class="flex flex-col">
				Тип продукту:
				<select class="js-product-type px-2 border-2 border-gray-200 rounded-lg text-lg">
					@foreach( ProductType::WITH_TEXT as $key => $value )
						<option value="{{ $key }}">{{ ucfirst($value) }}</option>
					@endforeach
				</select>
			</label>
			<label>
				Назва:
				<input class="js-product-name px-2 w-full border-2 border-gray-200 rounded-lg text-lg" type="text">
			</label>
			<label>
				Ціна:
				<input class="js-product-price px-2 w-full border-2 border-gray-200 rounded-lg text-lg" type="text">
			</label>
			<label class="flex flex-col">
				Фото:
				<input type="file" class="js-image-selector">
			</label>
		</div>
		<div class="m-auto w-40 h-40">
			<img class="js-image-preview rounded-xl" src="{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::ALL[0]])}}" alt="">
		</div>
	</div>
	<button class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto">Додати</button>
</div>
<script>
	$(document).ready(function () {
		const
			$popup = $("#popup"),
			$productTypeSelect = $popup.find(".js-product-type"),
			$titleInput = $popup.find(".js-product-name"),
			$priceInput = $popup.find(".js-product-price"),
			$imageSelector = $popup.find(".js-image-selector"),
			$imagePreview = $popup.find(".js-image-preview"),
			$submitButton = $popup.find(".js-submit")
		;

		$productTypeSelect.on("change", function () {
			let imagePath;
			if ($productTypeSelect.val() === '{{ ProductType::COFFEE }}') {
				imagePath = '{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::COFFEE]) }}';
			} else if ($productTypeSelect.val() === '{{ ProductType::DELICACY }}') {
				imagePath = '{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::DELICACY]) }}';
			} else if ($productTypeSelect.val() === '{{ ProductType::SPICE }}') {
				imagePath = '{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::SPICE]) }}';
			} else {
				return;
			}
			$imagePreview.attr("src", imagePath);
		});

		$imageSelector.on("change", function () {
			if ($(this)[0].files[0]) {
				let reader = new FileReader();
				reader.onload = function (e) {
					$imagePreview.attr("src", e.target.result);
				};

				reader.readAsDataURL($(this)[0].files[0]);
			}
		});

		$submitButton.on("click", function () {
			const formData = new FormData();
			formData.append("_token", '{{ csrf_token() }}');
			formData.append("product_type", $productTypeSelect.val());
			formData.append("title", $titleInput.val());
			formData.append("price", $priceInput.val());
			formData.append("image", $imageSelector[0].files[0]);

			$.ajax({
				type:        "POST",
				url:         '{{ route('action.product.add') }}',
				data:        formData,
				processData: false,
				contentType: false,
				success:     () => {
					popup.showInfo("Продукт створено!", '{{ InfoType::SUCCESS }}');
				}
			});
		});
	});
</script>