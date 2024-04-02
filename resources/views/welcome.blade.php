@php
	use Illuminate\Support\Facades\Auth;
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
</head>
<body>
	<div id="js-console" class="flex h-screen">
		@include('navigation')
		<div class="flex flex-col justify-between w-full">
			<div class="js-content flex flex-col p-4 overflow-y-auto gap-4">
				<div class="js-slider w-full h-40 bg-red-300 rounded-lg">Slider</div>
				<div class="flex justify-between gap-4">
					<div class="js-menu w-1/2 h-40 bg-red-300 rounded-lg">Menu</div>
					<div class="js-order w-1/2 h-40 bg-red-300 rounded-lg">Order</div>
				</div>
				<div class="js-feedbacks">Feedbacks</div>
				<div class="js-calendar">Calendar</div>
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
			$console = $("#js-console"),
			$content = $console.find(".js-content"),
			$navTabs = $navbar.find(".js-tab")
		;

		$navTabs.on("click", function () {
			changeMenu($(this).attr("data-route"));
		});

		@if( Auth::user() === NULL )
		$(".js-register-tab").on("click", function () {
			sendRequest(
				'{{ route('register') }}',
				{},
				(response) => {
					$content.html(response.view);
				},
				"GET"
			);
		});
		$(".js-login-tab").on("click", function () {
			sendRequest(
				'{{ route('login') }}',
				{},
				(response) => {
					$content.html(response.view);
				},
				"GET"
			);
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
