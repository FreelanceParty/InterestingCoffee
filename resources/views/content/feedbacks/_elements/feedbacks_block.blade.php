<div class="js-feedbacks flex flex-col border-2 rounded-lg">
	@include('content.feedbacks._elements.form')
	<div class="border-gray-200 border-b-2 mx-auto w-[95%]"></div>
	@if( ! empty($feedbacks) && $feedbacks->count() > 0 )
		@include('content.feedbacks._elements.feedbacks_preview')
	@endif
</div>