@php
	use App\ValuesObject\Constants\InfoType;
	use App\ValuesObject\Constants\ProductType;
@endphp
<div class="flex flex-col gap-2">
	<div class="flex gap-2">
		<div class="flex flex-col w-1/2 gap-2 text-sm">
			<label class="flex flex-col">
				Нова назва:
				<input class="js-product-name px-2 w-full border-2 border-gray-200 rounded-lg text-lg" type="text" value="{{ $product->getTitle() }}">
			</label>
			<label class="flex flex-col">
				Нова ціна:
				<input class="js-product-price px-2 w-full border-2 border-gray-200 rounded-lg text-lg" type="text" value="{{ $product->getPrice() }}">
			</label>
			<label class="flex flex-col">
				Новий опис:
				<input class="js-product-description px-2 w-full border-2 border-gray-200 rounded-lg text-lg" type="text" value="{{ $product->getDescription() }}">
			</label>
			<label class="flex flex-col">
				Нове фото:
				<input type="file" class="js-image-selector">
			</label>
		</div>
		<div class="m-auto w-40 h-40">
			<img class="js-image-preview rounded-xl" src="{{ $product->getImage() ?? asset(ProductType::DEFAULT_IMAGE_PATH[$product::PRODUCT_TYPE])}}" alt="">
		</div>
	</div>
	<button class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto disabled:bg-gray-300">Зберегти</button>
</div>
<script>
	$(document).ready(function () {
		const
			$popup = $("#popup"),
			$newTitleInput = $popup.find(".js-product-name"),
			$newPriceInput = $popup.find(".js-product-price"),
			$newDescriptionInput = $popup.find(".js-product-description"),
			$imageSelector = $popup.find(".js-image-selector"),
			$imagePreview = $popup.find(".js-image-preview"),
			$submitButton = $popup.find(".js-submit")
		;

		$imageSelector.on("change", function () {
			if ($(this)[0].files[0]) {
				let reader = new FileReader();
				reader.onload = function (e) {
					$imagePreview.attr("src", e.target.result);
				};

				reader.readAsDataURL($(this)[0].files[0]);
			}
		});

		$newTitleInput.on("keyup", checkInputs);
		$newPriceInput.on("keyup", checkInputs);

		function checkInputs() {
			if ($newTitleInput.val().length > 1 && $newPriceInput.val().length > 0) {
				$submitButton.prop("disabled", false);
			} else {
				$submitButton.prop("disabled", true);
			}
		}

		$submitButton.on("click", function () {
			const formData = new FormData();
			formData.append("_token", '{{ csrf_token() }}');
			formData.append("title", $newTitleInput.val());
			formData.append("price", $newPriceInput.val());
			formData.append("description", $newDescriptionInput.val());
			formData.append("image", $imageSelector[0].files[0]);
			formData.append("product_type", '{{ $product::PRODUCT_TYPE }}');
			formData.append("product_id", '{{ $product->getId() }}');

			$.ajax({
				type:        "POST",
				url:         '{{ route('action.product.edit') }}',
				data:        formData,
				processData: false,
				contentType: false,
				success:     (response) => {
					if (response.ack === "success") {
						popup.showInfo("Продукт оновлено!", '{{ InfoType::SUCCESS }}');
					} else if (response.ack === "fail") {
						popup.showInfo("Помилка", '{{ InfoType::ERROR }}');
					}
				}
			});
		});
	});
</script>