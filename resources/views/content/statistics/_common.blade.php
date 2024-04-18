@php
    use App\ValuesObject\Constants\StatisticCategories;
@endphp
<div class="grid grid-cols-2 gap-3">
	@include('content.statistics._elements.statistic_card', [
		'statistic' => statisticController()->findByCategory(StatisticCategories::COFFEES)
	])
	@include('content.statistics._elements.statistic_card', [
		'statistic' => statisticController()->findByCategory(StatisticCategories::ADDITIONS)
	])
	@include('content.statistics._elements.statistic_card', [
		'statistic' => statisticController()->findByCategory(StatisticCategories::DELICACIES)
	])
	@include('content.statistics._elements.statistic_card', [
		'statistic' => statisticController()->findByCategory(StatisticCategories::SEATS)
	])
</div>