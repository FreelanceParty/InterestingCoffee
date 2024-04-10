@php
	use App\ValuesObject\ProductType;
@endphp

<div id="menu-block" class="flex flex-col items-center gap-5">
	<div class="flex gap-4 items-center">
		@foreach( $coffees as $coffee )
			@include('content._elements.product_card', [
				'productType' => ProductType::COFFEE,
				'id'          =>$coffee->getId(),
				'image'       => $coffee->getImage(),
				'title'       => $coffee->getTitle(),
				'price'       => $coffee->getPrice(),
			])
		@endforeach
		<button data-route="{{route('content.coffees')}}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl h-20">Переглянути ще</button>
	</div>
	<div class="flex gap-4 items-center">
		@foreach( $spices as $spice )
			@include('content._elements.product_card', [
				'productType' => ProductType::SPICE,
				'id' => $spice->getId(),
				'image' => $spice->getImage(),
				'title' => $spice->getTitle(),
				'price' => $spice->getPrice(),
			])
		@endforeach
		<button data-route="{{route('content.spices')}}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl h-20">Переглянути ще</button>
	</div>
	<div class="flex gap-4 items-center">
		@foreach($delicacies as $delicacy)
			@include('content._elements.product_card', [
				'productType' => ProductType::DELICACY,
				'id' => $delicacy->getId(),
				'image' => $delicacy->getImage(),
				'title' => $delicacy->getTitle(),
				'price' => $delicacy->getPrice(),
			])
		@endforeach
		<button data-route="{{route('content.delicacies')}}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl h-20">Переглянути ще</button>
	</div>
</div>
<script>
	$(document).ready(function () {
		const $menuBlock = $("#menu-block");

		$menuBlock.find(".js-see-more").on("click", function () {
			changeMenu($(this).attr("data-route"));
		});
	});
</script>