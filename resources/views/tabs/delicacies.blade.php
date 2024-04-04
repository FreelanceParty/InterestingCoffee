<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $delicacies as $delicacy )
		@include('tabs._elements.product_card', [
			'image' => $delicacy->getImage() !== NULL ? 'data:image/png;base64,' . ($delicacy->getImage()) : asset('images/delicacy-default-img.png'),
			'title' => $delicacy->getTitle(),
			'price' => sprintf('%s $', $delicacy->getPrice()),
		])
	@endforeach
</div>