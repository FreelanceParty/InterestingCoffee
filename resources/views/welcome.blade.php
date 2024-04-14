@php
	use Illuminate\Support\Facades\Auth;
	use App\Models\User;
	/*** @var User $authUser */
	$authUser = Auth::user();
@endphp

		<!DOCTYPE>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Цікава кава</title>
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/7966ef3cd7.js" crossorigin="anonymous"></script>
</head>
<body>
	@include('popup._common')
	<div id="js-console" class="flex h-screen overflow-hidden">
		@include('navigation')
		<div class="flex flex-col justify-between w-full ml-28">
			<div class="js-content flex flex-col p-4 gap-4 h-full bg-white overflow-y-auto">
				@include('content.home._common')
			</div>
			@include('footer')
		</div>
	</div>
</body>
</html>
@include('_scripts.main')
<script>
	$(document).ready(function () {
		"use strict";

		const
			$navbar = $("#js-navbar"),
			$navTabs = $navbar.find(".js-tab")
		;

		$navTabs.on("click", function () {
			changeMenu($(this).attr("data-route"));
		});

		@if( $authUser === NULL )
		$(".js-register-tab").on("click", function () {
			popup.show("{{ route('popup.register') }}");
		});
		$(".js-login-tab").on("click", function () {
			popup.show("{{ route('popup.login') }}");
		});
		@else
		$(".js-logout-tab").on("click", function () {
			sendRequest(
				'{{ route('logout') }}',
				{},
				() => {
					location.reload();
				}
			);
		});
		@endif
	});
</script>
