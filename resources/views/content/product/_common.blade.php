<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $products as $product )
		@include('content._elements.product_card', [
			'id' => $product->getId(),
			'image' => $product->getImage() !== NULL ? 'data:image/png;base64,' . ($product->getImage()) : asset('images/coffee-default-img.png'),
			'title' => $product->getTitle(),
			'price' => sprintf('%s $', $product->getPrice()),
		])
	@endforeach
</div>