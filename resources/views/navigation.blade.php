@php
	use Illuminate\Support\Facades\Auth;
@endphp
<div id="js-navbar" class="flex flex-col overflow-y-auto w-1/12 h-full bg-yellow-300 p-4 gap-5 justify-between">
	<div class="flex flex-col gap-6 pt-2">
		<div data-route="{{ route('content.home') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-sharp fa-solid fa-house fa-xl"></i>
			Home
		</div>
		<div data-route="{{ route('content.coffees') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-sharp fa-solid fa-mug-saucer fa-xl"></i>
			Coffees
		</div>
		<div data-route="{{ route('content.spices') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-solid fa-candy-cane fa-xl"></i>
			Spices
		</div>
		<div data-route="{{ route('content.delicacies') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-solid fa-cookie fa-xl"></i>
			Delicacies
		</div>
		@if( $authUser !== NULL && $authUser->isAdmin() )
			<div data-route="{{ route('content.statistics') }}" class="js-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-chart-simple fa-xl"></i>
				Statistics
			</div>
		@endif
	</div>
	<div class="flex flex-col gap-5">
		@if( $authUser === NULL )
			<div class="js-login-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-right-to-bracket fa-xl"></i>
				Login
			</div>
			<div class="js-register-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-address-card fa-xl"></i>
				Register
			</div>
		@else
			<div class="js-logout-tab cursor-pointer items-center flex flex-col gap-2">
				<i class="fa-solid fa-right-to-bracket fa-rotate-180 fa-xl"></i>
				Logout
			</div>
		@endif
	</div>
</div>