<div class="flex gap-4 items-center mx-auto">
		@foreach( $products as $product )
		@include('content._elements.product_card', [
			'productType'      => $product::PRODUCT_TYPE,
			'id'               => $product->getId(),
			'image'            => $product->getImage(),
			'title'            => $product->getTitle(),
			'price'            => $product->getPrice() . ' $',
			'description'      => $product->getDescription(),
			'containerClasses' => 'h-full',
		])
	@endforeach
	<button data-route="{{ route($seeMoreRouteName) }}" class="js-see-more bg-blue-700 text-white px-3 py-1 rounded-xl h-20">Переглянути ще</button>
</div>