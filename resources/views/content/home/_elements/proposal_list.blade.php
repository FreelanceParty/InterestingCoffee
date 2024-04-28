@php
	use App\ValuesObject\Constants\ProposalTexts;
@endphp
<div class="flex flex-col gap-4 items-center">
	<div class="text-start text-2xl font-semibold lg:mr-auto">В нашій Цікавій кав'ярні Ви можете:</div>
	<div class="flex flex-col gap-2 pl-2 lg:text-lg">
		@foreach( ProposalTexts::ALL as $text )
			<div class="flex gap-2">
				<i class="fa fa-caret-right pt-1.5"></i>
				{{ $text }}
			</div>
		@endforeach
	</div>
</div>