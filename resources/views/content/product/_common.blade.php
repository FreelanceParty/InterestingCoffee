@php
    use App\ValuesObject\ProductType;
@endphp
<div class="flex flex-wrap gap-4 justify-center">
	@foreach( $products as $product )
		@include('content._elements.product_card', [
			'id' => $product->getId(),
			'image' => $product->getImage() ?? asset(ProductType::DEFAULT_IMAGE_PATH[$productType]),
			'title' => $product->getTitle(),
			'description' => $product->getDescription(),
			'price' => sprintf('%s $', $product->getPrice()),
		])
	@endforeach
</div>