@php
	use App\ValuesObject\Constants\InfoType;
	use App\ValuesObject\Constants\ProductType;
	use App\ValuesObject\Constants\AdditionType;
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
			<div class="js-addition-type-cont hidden">
				<label class="flex flex-col">
					Тип добавки:
					<select class="js-addition-type px-2 border-2 border-gray-200 rounded-lg text-lg">
						@foreach( AdditionType::WITH_TEXT as $key => $value )
							<option value="{{ $key }}">{{ ucfirst($value) }}</option>
						@endforeach
					</select>
				</label>
			</div>
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
				<div class=" flex flex-col gap-2">
					<input type="file" class="js-image-selector">
					<button class="js-delete-photo bg-blue-700 text-white px-3 py-1 rounded-md">Видалити фото</button>
				</div>
			</label>
		</div>
		<div class="m-auto w-40 h-40">
			<img class="js-image-preview rounded-xl" src="{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::ALL[0]])}}" alt="">
		</div>
	</div>
	<label class="flex flex-col">
		Опис:
		<textarea name="description" rows="4" class="js-product-description px-2 resize-none w-full border-2 border-gray-200 rounded-lg text-lg"></textarea>
	</label>
	<button class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto disabled:bg-gray-300" disabled>Додати</button>
</div>
<script>
	$(document).ready(function () {
		const
			$popup = $("#popup"),
			$productTypeSelect = $popup.find(".js-product-type"),
			$additionTypeCont = $popup.find(".js-addition-type-cont"),
			$additionSelect = $popup.find(".js-addition-type"),
			$titleInput = $popup.find(".js-product-name"),
			$priceInput = $popup.find(".js-product-price"),
			$descriptionInput = $popup.find(".js-product-description"),
			$imageSelector = $popup.find(".js-image-selector"),
			$imagePreview = $popup.find(".js-image-preview"),
			$submitButton = $popup.find(".js-submit"),
			$deleteButton = $popup.find(".js-delete-photo")
		;

		$productTypeSelect.on("change", function () {
			let imagePath;
			if ($productTypeSelect.val() === '{{ ProductType::COFFEE }}') {
				imagePath = '{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::COFFEE]) }}';
				$additionTypeCont.addClass("hidden");
			} else if ($productTypeSelect.val() === '{{ ProductType::DELICACY }}') {
				imagePath = '{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::DELICACY]) }}';
				$additionTypeCont.addClass("hidden");
			} else if ($productTypeSelect.val() === '{{ ProductType::ADDITION }}') {
				imagePath = '{{ asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::ADDITION]) }}';
				$additionTypeCont.removeClass("hidden");
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

		$titleInput.on("keyup", checkInputs);
		$priceInput.on("keyup", checkInputs);

		function checkInputs() {
			if ($titleInput.val().length > 1 && $priceInput.val().length > 0) {
				$submitButton.prop("disabled", false);
			} else {
				$submitButton.prop("disabled", true);
			}
		}

		$deleteButton.on("click", function () {
			$imageSelector.val(null);
			$imagePreview.attr("src", "{{asset(ProductType::DEFAULT_IMAGE_PATH[ProductType::ALL[0]])}}");
		});

		$submitButton.on("click", function () {
			const formData = new FormData();
			formData.append("_token", '{{ csrf_token() }}');
			formData.append("product_type", $productTypeSelect.val());
			formData.append("addition_type_id", $additionSelect.val());
			formData.append("title", $titleInput.val());
			formData.append("price", $priceInput.val());
			formData.append("description", $descriptionInput.val());
			if ($imageSelector[0].files[0] !== undefined) {
				formData.append("image", $imageSelector[0].files[0]);
			}

			$.ajax({
				type:        "POST",
				url:         '{{ route('action.product.add') }}',
				data:        formData,
				processData: false,
				contentType: false,
				success:     (response) => {
					if (response.ack === "success") {
						popup.showInfo("Продукт створено!", '{{ InfoType::SUCCESS }}');
					} else if (response.ack === "fail") {
						popup.showInfo("Помилка!!!", '{{InfoType::ERROR}}');
					}
				}
			});
		});
	});
</script>