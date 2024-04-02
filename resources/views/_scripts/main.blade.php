<script>
	"use strict";

	const
		$console = $("#js-console"),
		$content = $console.find(".js-content")
	;

	function sendRequest(route, data = {}, successFunction = () => {
	}, type = "POST") {
		data["_token"] = "{{ csrf_token() }}";
		$.ajax({
			type:    type,
			url:     route,
			data:    data,
			success: successFunction
		});
	}

	function changeMenu(route) {
		sendRequest(
			route,
			{},
			(response) => {
				$content.html(response.view);
			}
		);
	}
</script>