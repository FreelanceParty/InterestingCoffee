<div class="flex gap-2 border-2 border-gray-300 bg-gray-100 rounded-xl">
	<div class="flex flex-col justify-between gap-2 p-2">
		<div class="flex-col gap-2">
			<div>Ім'я: {{ $order->getUserName() }}</div>
			<div>Номер: {{ $order->getPhoneNumber() }}</div>
			<div>Місця: {{ $order->getSeatsCount() }}</div>
			<div>Дата: {{ $order->getDateTime()->format('d-M-Y H:i') }}</div>
			<div>Замовлено: {{ $order->getCreatedAt()->format('d-M-Y H:i') }}</div>
		</div>
		<div class="border-t-2 border-gray-300">
			Загальна сума: {{ $order->getTotalPrice() . ' $' }}
		</div>
	</div>
	@if( count($order->getProductsList()) > 0 )
		<div class="flex flex-col gap-2 p-2">
			@foreach( $order->getProductsList() as $title => $count )
				<div>{{ $title . ' x' . $count }}</div>
			@endforeach
		</div>
	@endif
</div>