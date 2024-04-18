@php
	use App\Models\Order;
	use App\ValuesObject\Constants\InfoType;
@endphp
<div class="js-create-order flex flex-col gap-2 min-w-80 w-full max-w-[800px]">
	<div class="flex gap-8">
		<div class="flex flex-col gap-2 w-2/5 border-2 p-6 shadow-xl rounded-md justify-between">
			<div class="flex flex-col gap-2">
				<input type="text" placeholder="Ваше ім'я" class="js-user-name-input rounded-lg border-2 border-gray-300 p-1">
				<input type="text" placeholder="Номер телефону" class="js-phone-number-input rounded-lg border-2 border-gray-300 p-1">
				<label>Оберіть дату та час:
					<input
							type="datetime-local"
							class="js-order-date border border-gray-300 rounded-xl w-full"
							min="2018-06-07T00:00"
							max="2030-06-14T00:00"
					/>
				</label>
				<label class="flex flex-col">
					Кількість місць:
					<select class="js-seats-count px-2 border-2 border-gray-200 rounded-lg text-lg">
						@foreach( Order::SEATS_COUNT_PRICE as $key => $value )
							<option data-count="{{ $key }}" data-price="{{ $value }}">{{ sprintf('%s: %s$', $key, $value) }}</option>
						@endforeach
					</select>
				</label>
			</div>
			<div class="flex justify-between mt-top">
				<div class="flex gap-1">
					<div>Ціна:</div>
					<div class="js-price-place text-green-600   ">0</div>
					<div class="text-green-600">$</div>
				</div>
				<button class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto disabled:bg-gray-300" disabled>Замовити</button>
			</div>
		</div>
		<div class="flex flex-col gap-2 justify-between w-3/5 border-2 p-6 rounded-md shadow-xl">
			<div class="flex flex-col gap-6">
				<div class="border-2 rounded-md p-2 shadow-md overflow-y-auto max-h-80">
					<div class="js-order-header p-4">Замовлення:</div>
					<div class="js-order-coffees-header p-4 hidden">Кава:</div>
					<div class="js-coffees-list flex flex-wrap gap-3 border-b-2 p-2">
					</div>
					<div class="js-order-delicacies-header p-4 hidden">Смаколики:</div>
					<div class="js-delicacies-list flex flex-wrap gap-1 p-2">
					</div>
				</div>
				<div class="flex flex-col gap-2">
					Додати:
					<div class="flex gap-2">
						<select class="js-coffee-select px-2 border-2 border-gray-200 rounded-lg text-lg hover:scale-105 transition">
							@foreach( coffeeController()->getAll() as $coffee )
								<option data-id="{{ $coffee->getId() }}" data-price="{{ $coffee->getPrice() }}">{{ $coffee->getTitle() }}, {{$coffee->getPrice()}}$</option>
							@endforeach
						</select>
						<div class="flex gap-2">
							<select class="js-addition-select px-2 border-2 border-gray-200 rounded-lg text-lg hover:scale-105 transition">
								@foreach( additionController()->getAll() as $addition )
									<option data-id="{{ $addition->getId() }}" data-price="{{ $addition->getPrice() }}">{{ $addition->getTitle() }}, {{$addition->getPrice()}}$</option>
								@endforeach
							</select>
							<button class="js-add-coffee bg-blue-700 text-white px-3 py-1 rounded-xl disabled:bg-gray-300 hover:scale-105 transition">+</button>
						</div>
					</div>
					<div class="flex gap-2">
						<select class="js-delicacy-select px-2 border-2 border-gray-200 rounded-lg text-lg hover:scale-105 transition">
							@foreach( delicacyController()->getAll() as $delicacy )
								<option data-id="{{ $delicacy->getId() }}" data-price="{{ $delicacy->getPrice() }}">{{ $delicacy->getTitle() }}, {{$delicacy->getPrice()}}$</option>
							@endforeach
						</select>
						<button class="js-add-delicacy bg-blue-700 text-white px-3 py-1 rounded-xl disabled:bg-gray-300">+</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		const
			$popupContent = $(".js-create-order"),
			$seatsCountInput = $popupContent.find(".js-seats-count"),
			$userNameInput = $popupContent.find(".js-user-name-input"),
			$phoneNumberInput = $popupContent.find(".js-phone-number-input"),
			$dateInput = $popupContent.find(".js-order-date"),
			$coffeesListContainer = $popupContent.find(".js-coffees-list"),
			$delicaciesListContainer = $popupContent.find(".js-delicacies-list"),
			$coffeeSelect = $popupContent.find(".js-coffee-select"),
			$additionSelect = $popupContent.find(".js-addition-select"),
			$delicacySelect = $popupContent.find(".js-delicacy-select"),
			$addCoffeeBtn = $popupContent.find(".js-add-coffee"),
			$addDelicacyBtn = $popupContent.find(".js-add-delicacy"),
			$pricePlace = $popupContent.find(".js-price-place"),
			$submitBtn = $popupContent.find(".js-submit"),
			dateTimeNow = new Date().toISOString().slice(0, 16),
			$coffeeLabel = $popupContent.find(".js-order-coffees-header"),
			$delicacyLabel = $popupContent.find(".js-order-delicacies-header")
		;

		$pricePlace.text($seatsCountInput.find("option:selected").data("price"));
		$dateInput.val(dateTimeNow);

		$userNameInput.on("keyup", checkInputs);
		$phoneNumberInput.on("keyup", checkInputs);
		$dateInput.on("change", checkInputs);

		$addCoffeeBtn.on("click", function () {
			const
				$selectedCoffeeOption = $coffeeSelect.find("option:selected"),
				$selectedAdditionOption = $additionSelect.find("option:selected")
			;
			addCoffeeBadge(
				$selectedCoffeeOption.data("id"),
				$selectedCoffeeOption.val(),
				$selectedCoffeeOption.data("price"),
				$selectedAdditionOption.data("id"),
				$selectedAdditionOption.val(),
				$selectedAdditionOption.data("price")
			);
			const $deleteBadgeButtons = $popupContent.find(".js-delete-badge");
			$deleteBadgeButtons.on("click", function () {
				$(this).closest(".js-product-badge").remove();
				switchHeadersVisibility();
			});
			switchHeadersVisibility();
		});

		$addDelicacyBtn.on("click", function () {
			const $selectedDelicacyOption = $delicacySelect.find("option:selected");
			addDelicacyBadge(
				$selectedDelicacyOption.data("id"),
				$selectedDelicacyOption.val(),
				$selectedDelicacyOption.data("price")
			);
			const $deleteBadgeButtons = $popupContent.find(".js-delete-badge");
			$deleteBadgeButtons.on("click", function () {
				$(this).closest(".js-product-badge").remove();
				switchHeadersVisibility();
			});
			switchHeadersVisibility();
		});

		function switchHeadersVisibility() {
			const $coffeeBadges = $popupContent.find(".js-coffee-badge");
			const $delicacyBadges = $popupContent.find(".js-delicacy-badge");

			if($coffeeBadges.length > 0 && $coffeeLabel.hasClass("hidden")) {
				$coffeeLabel.removeClass("hidden");
			} else if($coffeeBadges.length === 0 && !$coffeeLabel.hasClass("hidden")) {
				$coffeeLabel.addClass("hidden");
			}
			if($delicacyBadges.length > 0 && $delicacyLabel.hasClass("hidden")) {
				$delicacyLabel.removeClass("hidden");
			} else if($delicacyBadges.length === 0 && !$delicacyLabel.hasClass("hidden")) {
				$delicacyLabel.addClass("hidden");
			}
		}

		$seatsCountInput.on("change", function () {
			updateTotalPrice();
		});

		function checkInputs() {
			if ($userNameInput.val().length > 1 && isValidPhoneNumber($phoneNumberInput.val()) && $dateInput.val() > dateTimeNow) {
				$submitBtn.prop("disabled", false);
			} else {
				$submitBtn.prop("disabled", true);
			}
		}

		function updateTotalPrice() {
			const
				$badges = $(".js-product-badge"),
				seatsPrice = $seatsCountInput.find("option:selected").data("price")
			;
			let badgesPrice = 0;
			$badges.each(function () {
				let price = parseFloat($(this).data("price"));
				if ( ! isNaN(price)) {
					badgesPrice += price;
				}
			});
			$pricePlace.text((badgesPrice + seatsPrice).toFixed(2));
		}

		$submitBtn.on("click", function () {
			const $badges = $popupContent.find(".js-product-badge");
			let
				addedAdditionsIds = [],
				addedCoffeesIds = [],
				addedDelicaciesIds = []
			;
			$badges.each(function () {
				if ($(this).data("addition-id")) {
					addedAdditionsIds.push($(this).data("addition-id"));
				}
				if ($(this).data("coffee-id")) {
				addedCoffeesIds.push($(this).data("coffee-id"));
				}
				if ($(this).data("delicacy-id")) {
				addedDelicaciesIds.push($(this).data("delicacy-id"));
				}
			});
			sendRequest(
				'{{ route('action.create-order') }}',
				{
					user_name:      $userNameInput.val(),
					phone_number:   $phoneNumberInput.val(),
					date_time:      $dateInput.val(),
					seats_count:    $seatsCountInput.find("option:selected").data("count"),
					total_price:    $pricePlace.text(),
					coffees_ids:    addedCoffeesIds,
					additions_ids:  addedAdditionsIds,
					delicacies_ids: addedDelicaciesIds

				},
				(response) => {
					if (response.ack === "success") {
						popup.showInfo("Замовлення прийнято!", '{{ InfoType::SUCCESS }}');
					} else if (response.ack === "fail") {
						popup.showInfo("Помилка!!!", '{{InfoType::ERROR}}');
					}
				}
			);
		});

		function addCoffeeBadge(coffeeId, coffeeTitle, coffeePrice, additionId, additionTitle, additionPrice) {
			let badge = $("<div>", {
				"class":            "js-product-badge js-coffee-badge flex px-3 py-1 text-center rounded-xl gap-4 bg-amber-100 w-fit",
				"data-price":       coffeePrice + additionPrice,
				"data-coffee-id":   coffeeId,
				"data-addition-id": additionId,
				text:               `\'${coffeeTitle}\' з \'${additionTitle}\'`
			});
			badge.append("<div class='js-delete-badge text-center rounded-xl flex cursor-pointer ml-auto'>X</div>");
			$coffeesListContainer.append(badge);
			updateTotalPrice();
		}

		function addDelicacyBadge(delicacyId, delicacyTitle, delicacyPrice) {
			let badge = $("<div>", {
				"class":            "js-product-badge js-delicacy-badge flex px-3 py-1 text-center rounded-xl gap-4 bg-blue-100 w-fit",
				"data-price":       delicacyPrice,
				"data-delicacy-id": delicacyId,
				text:               `\'${delicacyTitle}\'`
			});
			badge.append("<div class='js-delete-badge text-center rounded-xl flex cursor-pointer ml-auto'>X</div>");
			$delicaciesListContainer.append(badge);
			updateTotalPrice();
		}
	});
</script>