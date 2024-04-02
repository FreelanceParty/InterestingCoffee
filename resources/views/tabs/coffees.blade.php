<div class="flex flex-wrap gap-4">
	@foreach( $coffees as $coffee )
		@include('tabs._elements.product_card', [
			'image' => 'Image',
			'title' => $coffee->getTitle(),
			'price' => $coffee->getPrice(),
		])
	@endforeach
</div>