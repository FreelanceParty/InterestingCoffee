@php
	use Illuminate\Support\Facades\Auth;
@endphp
<div id="js-navbar" class="flex flex-col overflow-y-auto w-1/12 h-full bg-yellow-300 p-4 gap-5 justify-between">
	<div class="flex flex-col gap-4 cursor-pointer">
		<div data-route="{{ route('home') }}" class="js-tab js-home-tab items-center flex flex-col gap-2">
			<i class="fa-sharp fa-solid fa-house fa-xl"></i>
			Home
		</div>
		<div data-route="{{ route('coffees') }}" class="js-tab js-coffees-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-sharp fa-solid fa-mug-saucer fa-xl"></i>
			Coffees
		</div>
		<div data-route="{{ route('spices') }}" class="js-tab js-spices-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-solid fa-candy-cane fa-xl"></i>
			Spices
		</div>
		<div data-route="{{ route('delicacies') }}" class="js-tab js-delicacies-tab cursor-pointer items-center flex flex-col gap-2">
			<i class="fa-solid fa-cookie fa-xl"></i>
			Delicacies
		</div>
	</div>
	<div class="flex flex-col gap-5">
		@if( Auth::user() === NULL )
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