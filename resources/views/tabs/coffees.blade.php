<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $coffees as $coffee )
		@include('tabs._elements.product_card', [
			'image' => $coffee->getImage() !== NULL ? 'data:image/png;base64,' . ($coffee->getImage()) : asset('images/coffee-default-img.png'),
			'title' => $coffee->getTitle(),
			'price' => sprintf('%s $', $coffee->getPrice()),
		])
	@endforeach
</div>