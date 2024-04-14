@php
	use App\ValuesObject\Constants\ProductType;
@endphp

<div id="menu-block" class="flex flex-col items-center gap-5">
	@include('content.menu._elements.row', [
		'products' => $coffees,
		'seeMoreRouteName' => 'content.coffees',
	])
	@include('content.menu._elements.row', [
		'products' => $additions,
		'seeMoreRouteName' => 'content.additions',
	])
	@include('content.menu._elements.row', [
		'products' => $delicacies,
		'seeMoreRouteName' => 'content.delicacies',
	])
</div>
<script>
	$(document).ready(function () {
		const $menuBlock = $("#menu-block");

		$menuBlock.find(".js-see-more").on("click", function () {
			changeMenu($(this).attr("data-route"));
		});
	});
</script>
