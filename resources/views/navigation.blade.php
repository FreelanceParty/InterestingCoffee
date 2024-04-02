@php
	use Illuminate\Support\Facades\Auth;
@endphp
<div id="js-navbar" class="flex flex-col overflow-y-auto h-full bg-yellow-300 p-4 gap-4 justify-between">
	<div class="flex flex-col gap-4">
		<div class="js-tab js-home-tab">
			Home
		</div>
		<div data-route="{{ route('coffees') }}" class="js-tab js-coffees-tab">
			Coffees
		</div>
		<div class="js-tab js-spices-tab">
			Spices
		</div>
		<div class="js-tab js-delicacies-tab">
			Delicacies
		</div>
	</div>
	<div class="flex flex-col gap-4">
	@if( Auth::user() === NULL )
		<div class="js-login-tab">
			Login
		</div>
		<div class="js-register-tab">
			Register
		</div>
	@else
		<div class="js-logout-tab">
			Logout
		</div>
	@endif
	</div>
</div>
