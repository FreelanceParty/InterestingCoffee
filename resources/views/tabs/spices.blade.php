<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $spices as $spice )
		@include('tabs._elements.product_card', [
			'image' => $spice->getImage() !== NULL ? 'data:image/png;base64,' . ($spice->getImage()) : asset('images/spice-default-img.png'),
			'title' => $spice->getTitle(),
			'price' => sprintf('%s $', $spice->getPrice()),
		])
	@endforeach
</div>