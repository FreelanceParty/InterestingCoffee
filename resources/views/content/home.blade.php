<div class="js-slider w-full h-40 bg-red-300 rounded-lg">Слайдер</div>
<div class="flex justify-between gap-4">
	<div class="js-menu w-1/2 h-40 bg-red-300 rounded-lg">Меню</div>
	<div class="js-order w-1/2 h-40 bg-red-300 rounded-lg">Замовлення</div>
</div>
<div class="flex w-full h-80 justify-center">
	<div class="js-calendar w-full h-80">@include('content._elements.calendar')</div>
</div>
<div class="js-feedbacks flex flex-col border-2 rounded-lg">
	@include('content._elements.feedback_field')
	<div class="border-gray-200 border-b-2 mx-auto w-[95%]"></div>
	@include('content._elements.feedbacks_block')
</div>