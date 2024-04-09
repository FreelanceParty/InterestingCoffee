@include('content.home._elements.slider')
<div class="flex justify-between gap-4">
	<div data-route="{{ route('content.menu') }}" class="js-menu w-1/2 bg-gradient-to-b from-gray-200 to-gray-300 rounded-lg justify-center shadow-xl cursor-pointer">
		<img class="w-full " src="https://www.pngitem.com/pimgs/m/133-1331622_transparent-menu-png-logo-png-download.png" alt="Menu">
	</div>
	<div class="js-order w-1/2 h-40 bg-red-300 rounded-lg">Замовлення</div>
</div>
<div class="flex w-full h-80 justify-center">
	<div class="js-calendar w-full h-80">@include('content.home._elements.calendar')</div>
</div>
<div class="js-feedbacks flex flex-col border-2 rounded-lg">
	@include('content._elements.feedback_field')
	<div class="border-gray-200 border-b-2 mx-auto w-[95%]"></div>
	@include('content._elements.feedbacks_block')
</div>
<script>
	$(document).ready(function () {
		$(".js-menu").on("click", function () {
			changeMenu($(this).attr("data-route"));
		})
	})
</script>
