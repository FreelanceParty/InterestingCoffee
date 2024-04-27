<div id="order-card-{{ $order->getId() }}" class="flex gap-2 border-2 border-gray-300 bg-yellow-100 rounded-xl shadow-xl">
	<div class="flex flex-col justify-between gap-2 p-2 @if( count($order->getProductsList()) > 0 ) rounded-l-xl @endif">
		<div class="flex-col gap-2">
			<div>Ім'я: {{ $order->getUserName() }}</div>
			<div>Номер: {{ $order->getPhoneNumber() }}</div>
			<div>Місця: {{ $order->getSeatsCount() }}</div>
			<div>Дата: {{ $order->getDateTime()->format('d-M-Y H:i') }}</div>
			<div>Замовлено: {{ $order->getCreatedAt()->format('d-M-Y H:i') }}</div>
		</div>
		<div class="border-t-2">
			Загальна сума: {{ $order->getTotalPrice() . ' $' }}
		</div>
	</div>
	<div class="flex flex-col gap-2 p-2 border-l-2">
		@if( count($order->getProductsList()) > 0 )
			@foreach( $order->getProductsList() as $title => $count )
				<div class="border-b-2">{{ $title . ' x' . $count }}</div>
			@endforeach
		@endif
		@if( $authUser !== NULL && $authUser->isAdmin())
			<div data-route="{{ route('popup.order.delete') }}"
					class="mt-auto hover:scale-105 transition js-order-delete min-w-20 w-full h-7 flex justify-center items-center bg-red-500 rounded-xl cursor-pointer text-white">
				Видалити
			</div>
			<script>
				$(document).ready(function () {
					const
						$orderCard = $('#order-card-{{ $order->getId() }}'),
						$deleteBtn = $orderCard.find(".js-order-delete")
					;

					$deleteBtn.on("click", function () {
						popup.show(
							$(this).data("route"),
							{
								order_id: '{{ $order->getId() }}'
							}
						);
					});
				});
			</script>
		@endif
	</div>
</div>