@php
	use App\Models\User;
	use Illuminate\Support\Facades\Auth;
	use App\ValuesObject\Constants\ProductType;
	/*** @var User $authUser */
	$authUser = Auth::user();
@endphp

<div id="{{ $productType }}-{{ $id }}"
		class="js-product-card flex flex-col w-[250px] border-2 border-gray-300 rounded-lg shadow-xl transition duration-200 ease-in-out hover:scale-105 hover:shadow-2xl">
	<div class="flex w-[250px] h-[250px] items-center justify-center border-b-2 border-gray-300 p-3">
		<img class="w-full h-full rounded-xl" src="{{ $image ?? asset(ProductType::DEFAULT_IMAGE_PATH[$productType]) }}" alt='{{ $title }}'>
	</div>
	<div class="flex flex-col h-full gap-2 justify-between text-center bg-amber-100 rounded-b-lg">
		<div class="flex gap-2 justify-between px-2">
			<div class="font-semibold text-lg text-nowrap">
				{{ $title }}
			</div>
			<div>
				{{ $price }}
			</div>
		</div>
		<div class="text-center mb-auto px-2 pb-1">
			{{$description}}
		</div>

		@if( $authUser !== NULL && $authUser->isAdmin())
			<div class="flex justify-center gap-2 p-1">
				<div data-route="{{ route('popup.product.edit') }}" class="js-product-action w-full h-7 flex justify-center items-center bg-blue-500 rounded-xl cursor-pointer hover:text-amber-50">
					Змінити
				</div>
				<div data-route="{{ route('popup.product.delete') }}" class="js-product-action w-full h-7 flex justify-center items-center bg-red-500 rounded-xl cursor-pointer hover:text-amber-50">
					Видалити
				</div>
			</div>
			<script>
				$(document).ready(function () {
					const
						$productCard = $('#{{ $productType }}-{{ $id }}'),
						$actionBtn = $productCard.find(".js-product-action")
					;

					$actionBtn.on("click", function () {
						popup.show(
							$(this).data("route"),
							{
								product_id:   '{{ $id }}',
								product_type: '{{ $productType }}'
							}
						);
					});
				});
			</script>
		@endif
	</div>
</div>