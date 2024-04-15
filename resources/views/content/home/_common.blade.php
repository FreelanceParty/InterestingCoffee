@include('content.home._elements.slider')
<div class="flex flex-col sm:flex-row items-center justify-around gap-4">
	<div data-route="{{ route('content.menu') }}" class="js-menu w-1/2 max-w-80 rounded-lg justify-center cursor-pointer transition duration-200 ease-in-out hover:scale-[1.02]">
		<img class="w-full " src="https://cdn.icon-icons.com/icons2/3348/PNG/512/menu_restaurant_coffee_icon_210208.png" alt="Меню">
		<div class="text-center">Меню</div>
	</div>
	<div data-route="{{ route('popup.create-order') }}" class="js-create-order w-1/2 max-w-80 rounded-lg justify-center cursor-pointer transition duration-200 ease-in-out hover:scale-[1.02]">
		<img class="w-full " src="https://cdn-icons-png.flaticon.com/512/1187/1187436.png" alt="Замовлення">
		<div class="text-center">Замовити столик</div>
	</div>
</div>
<div class="flex w-full h-80 justify-center">
	<div class="js-calendar w-full h-80">@include('content.home._elements.calendar')</div>
</div>
@include('content.feedbacks._elements.feedbacks_block')
<script>
	$(document).ready(function () {
		$(".js-menu").on("click", function () {
			changeMenu($(this).attr("data-route"));
		});
		$(".js-create-order").on("click", function () {
			popup.show($(this).data("route"));
		});
	});
</script>
