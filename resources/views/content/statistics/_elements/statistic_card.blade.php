@php
    use App\ValuesObject\Constants\StatisticCategories;
@endphp
<div class="flex flex-col gap-2 w-80 border-2 border-gray-300 rounded-xl bg-gray-100 p-2">
	<div class="border-b-2">{{ StatisticCategories::WITH_TEXT[$statistic->getCategory()] }}</div>
	<div class="flex flex-col gap-1">
		@foreach( $statistic->getSortedList(TRUE) as $key => $value)
			<div class="flex justify-between gap-1">
				<div>{{ $key }}</div>
				<div>{{ $value }}</div>
			</div>
		@endforeach
	</div>
</div>