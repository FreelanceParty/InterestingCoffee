<div class="flex flex-wrap gap-2">
	@foreach( $orders as $order )
		@include('content.orders._elements.order_card', $order)
	@endforeach
</div>