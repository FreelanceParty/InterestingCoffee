@if( ! empty($orders) && count($orders) > 0)
	<div class="flex flex-wrap gap-2">
		@foreach( $orders as $order )
			@include('content.orders._elements.order_card', $order)
		@endforeach
	</div>
@else
	<div class="flex justify-center">Замовлень немає</div>
@endif
