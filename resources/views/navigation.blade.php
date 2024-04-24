@php
	use Illuminate\Support\Facades\Auth;
@endphp
<div id="js-navbar" class="fixed flex flex-col w-28 h-[calc(100%-64px)] bg-yellow-300 p-4 gap-5 justify-between text-center mt-16">
	<div class="flex flex-col gap-8 pt-2">
		<div data-route="{{ route('content.home') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-sharp fa-solid fa-house fa-xl"></i>
			Головна
		</div>
		<div data-route="{{ route('content.coffees') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-sharp fa-solid fa-mug-saucer fa-xl"></i>
			Кава
		</div>
		<div data-route="{{ route('content.additions') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-solid fa-candy-cane fa-xl"></i>
			Добавки
		</div>
		<div data-route="{{ route('content.delicacies') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-solid fa-cookie fa-xl"></i>
			Смаколики
		</div>
		@if( $authUser !== NULL && $authUser->isAdmin() )
			<div data-route="{{ route('content.statistics') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-chart-simple fa-xl"></i>
				Статистика
			</div>
			<div data-route="{{ route('popup.product.add') }}" class="js-add-product cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-square-plus fa-xl"></i>
				Додати продукт
			</div>
			<script>
				$(document).ready(function () {
					const
						$navBar = $("#js-navbar"),
						$addProductTab = $navBar.find(".js-add-product")
					;
					$addProductTab.on("click", function () {
						popup.show($(this).data("route"));
					});
				});
			</script>
		@endif
	</div>
	<div class="flex flex-col gap-8">
		@if( $authUser === NULL )
			<div class="js-login-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-right-to-bracket fa-xl"></i>
				Увійти
			</div>
			<div class="js-register-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-address-card fa-xl"></i>
				Реєстрація
			</div>
		@else
			@if( $authUser->isAdmin() )
				<div data-route="{{ route('content.orders') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
					<i class="fa-solid fa-chair fa-xl"></i>
					Замовлення
				</div>
			@endif
			<div data-route="{{ route('content.questions') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-question fa-xl"></i>
				Запитання
			</div>
			<div class="js-logout-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-right-to-bracket fa-rotate-180 fa-xl"></i>
				Вийти
			</div>
		@endif
	</div>
</div>