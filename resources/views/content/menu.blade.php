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
				'description' => $coffee->getDescription(),
			])
		@endforeach
		<button data-route="{{route('content.coffees')}}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl h-20">Переглянути ще</button>
	</div>
	<div class="flex gap-4 items-center">
		@foreach( $additions as $addition )
			@include('content._elements.product_card', [
				'productType' => ProductType::ADDITION,
				'id' => $addition->getId(),
				'image' => $addition->getImage(),
				'title' => $addition->getTitle(),
				'price' => $addition->getPrice(),
				'description' => $addition->getDescription(),
			])
		@endforeach
		<button data-route="{{route('content.additions')}}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl h-20">Переглянути ще</button>
	</div>
	<div class="flex gap-4 items-center">
		@foreach($delicacies as $delicacy)
			@include('content._elements.product_card', [
				'productType' => ProductType::DELICACY,
				'id' => $delicacy->getId(),
				'image' => $delicacy->getImage(),
				'title' => $delicacy->getTitle(),
				'price' => $delicacy->getPrice(),
				'description' => $delicacy->getDescription(),
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
