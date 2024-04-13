<div class="js-login-form min-w-80">
	<div class="">
		<label class="block font-medium text-sm text-gray-700">Email</label>
		<input id="email" type="email" name="email" class="border block p-1 mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus
				autocomplete="username">
	</div>

	<div class="mt-4">
		<label class="block font-medium text-sm text-gray-700">Пароль</label>
		<input id="password" type="password" name="password" class="border block p-1 mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required
				autocomplete="current-password">
	</div>

	<div class="block mt-4">
		<label for="remember_me" class="inline-flex items-center">
			<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
			<span class="ms-2 text-sm text-gray-600">Запам'ятати мене</span>
		</label>
	</div>

	<div class="flex items-center justify-end mt-6">
		<button type="submit" disabled
				class="disabled:bg-gray-300 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
			Увійти
		</button>
	</div>
</div>
<script>
	$(document).ready(function () {
		const
			$loginForm = $(".js-login-form"),
			$submitBtn = $loginForm.find("button"),
			$emailInput = $loginForm.find("#email"),
			$passwordInput = $loginForm.find("#password"),
			$rememberMeCheckbox = $loginForm.find("#remember_me")
		;

		$emailInput.on("keyup", checkInputs);
		$emailInput.on("change", checkInputs);
		$passwordInput.on("keyup", checkInputs);

		function checkInputs() {
			if (validateEmail($emailInput.val()) && $passwordInput.val().length > 0) {
				$submitBtn.attr("disabled", false);
				$emailInput.removeClass("!border-red-400");
				$passwordInput.removeClass("!border-red-400");
			} else {
				$submitBtn.attr("disabled", true);
			}
		}

		$submitBtn.on("click", function () {
			sendRequest(
				'{{ route('login') }}',
				{
					email:    $emailInput.val(),
					password: $passwordInput.val(),
					remember: $rememberMeCheckbox.checked
				},
				(response) => {
					if (response.ack === "success") {
						window.location.reload();
					} else {
						$submitBtn.attr("disabled", true);
						$emailInput.addClass("!border-red-400");
						$passwordInput.addClass("!border-red-400");
					}
				}
			);
		});
	});
</script>
