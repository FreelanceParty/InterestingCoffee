@php
	use App\Models\Order;
	use App\ValuesObject\Constants\InfoType;
@endphp
<div class="js-create-order flex flex-col gap-2 min-w-80 w-full max-w-[800px]">
	<div class="flex gap-2">
		<div class="flex flex-col gap-2 w-1/2">
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
			<div class="flex justify-between">
				<div class="flex gap-1">
					<div>Ціна:</div>
					<div class="js-price-place">0</div>
					<div>$</div>
				</div>
				<button class="js-submit bg-blue-700 text-white px-3 py-1 rounded-xl ml-auto disabled:bg-gray-300" disabled>Замовити</button>
			</div>
		</div>
		<div class="flex flex-col gap-2 justify-between w-1/2">
			<div class="flex flex-col gap-2">
				<div class="js-order-header">Замовлення:</div>
				<div class="js-order-coffees-header">Кава:</div>
				<div class="js-coffees-list flex flex-wrap gap-1">
				</div>
				<div class="js-order-coffees-header">Смаколики:</div>
				<div class="js-delicacies-list flex flex-wrap gap-1">
				</div>
				<div class="flex flex-col gap-2">
					Додати:
					<div class="flex gap-2">
						<select class="js-coffee-select px-2 border-2 border-gray-200 rounded-lg text-lg">
							@foreach( coffeeController()->getAll() as $coffee )
								<option data-id="{{ $coffee->getId() }}" data-price="{{ $coffee->getPrice() }}">{{ $coffee->getTitle() }}</option>
							@endforeach
						</select>
						<select class="js-addition-select px-2 border-2 border-gray-200 rounded-lg text-lg">
							@foreach( additionController()->getAll() as $addition )
								<option data-id="{{ $addition->getId() }}" data-price="{{ $addition->getPrice() }}">{{ $addition->getTitle() }}</option>
							@endforeach
						</select>
						<button class="js-add-coffee bg-blue-700 text-white px-3 py-1 rounded-xl disabled:bg-gray-300">+</button>
					</div>
					<div class="flex gap-2">
						<select class="js-delicacy-select px-2 border-2 border-gray-200 rounded-lg text-lg">
							@foreach( delicacyController()->getAll() as $delicacy )
								<option data-id="{{ $delicacy->getId() }}" data-price="{{ $delicacy->getPrice() }}">{{ $delicacy->getTitle() }}</option>
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
			dateTimeNow = new Date().toISOString().slice(0, 16)
		;
		let
			addedCoffeesIds = [],
			addedAdditionsIds = [],
			addedDelicaciesIds = []
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
		});

		$addDelicacyBtn.on("click", function () {
			const $selectedDelicacyOption = $delicacySelect.find("option:selected");
			addDelicacyBadge(
				$selectedDelicacyOption.data("id"),
				$selectedDelicacyOption.val(),
				$selectedDelicacyOption.data("price")
			);
		});

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
				() => {
					popup.showInfo("Замовлення прийнято!", '{{ InfoType::SUCCESS }}');
				}
			);
		});

		function addCoffeeBadge(coffeeId, coffeeTitle, coffeePrice, additionId, additionTitle, additionPrice) {
			let badge = $("<div>", {
				"class":      "js-product-badge px-3 py-1 text-center rounded-xl bg-amber-100 w-fit",
				text:         `\'${coffeeTitle}\' із \'${additionTitle}\'`,
				"data-price": coffeePrice + additionPrice
			});
			addedCoffeesIds.push(coffeeId);
			addedAdditionsIds.push(additionId);
			$coffeesListContainer.append(badge);
			updateTotalPrice();
		}

		function addDelicacyBadge(delicacyId, delicacyTitle, delicacyPrice) {
			let badge = $("<div>", {
				"class":      "js-product-badge px-3 py-1 text-center rounded-xl bg-blue-100 w-fit",
				text:         `\'${delicacyTitle}\'`,
				"data-price": delicacyPrice
			});
			addedDelicaciesIds.push(delicacyId);
			$delicaciesListContainer.append(badge);
			updateTotalPrice();
		}
	});
</script>