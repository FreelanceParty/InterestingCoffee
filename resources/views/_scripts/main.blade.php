@php
	use App\ValuesObject\Constants\InfoType;
@endphp

<script>
	"use strict";

	const
		$console = $("#js-console"),
		$content = $console.find(".js-content")
	;

	function validateEmail(email) {
		return String(email).toLowerCase().match(
			/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		);
	}

	function sendRequest(route, data = {}, successFunction = () => {
	}) {
		data["_token"] = "{{ csrf_token() }}";
		$.ajax({
			type:    "POST",
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

	const popup = (function () {
		const
			$popup = $("#popup"),
			$popupHeaderText = $popup.find(".js-popup-header-text"),
			$popupContent = $popup.find(".js-popup-content"),
			$popupClose = $popup.find(".js-popup-close")
		;

		$popupClose.on("click", hidePopup);
		$popup.on("click", function (event) {
			if (event.target === this) {
				hidePopup();
			}
		});

		function hidePopup() {
			$popup.addClass("hidden");
		}

		$(document).keyup(function (e) {
			if (e.key === "Escape") {
				hidePopup();
			}
		});

		return {
			show:     function (route, data = {}) {
				sendRequest(
					route,
					data,
					(response) => {
						$popup.removeClass("hidden");
						$popupHeaderText.text(response.headerText ?? "");
						$popupContent.html(response.html);
					}
				);
			},
			showInfo: function (text, infoType = '{{ InfoType::INFO }}') {
				this.show(
					'{{ route('popup.info') }}',
					{
						text:      text,
						info_type: infoType
					}
				);
			},
			hide:     function () {
				hidePopup();
			}
		};
	}());
</script>