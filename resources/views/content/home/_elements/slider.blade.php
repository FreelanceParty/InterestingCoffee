<style>
	.fa:hover {
		transform:  rotate(360deg);
		transition: 1s;
		color:      darkgray;
	}
	.footer-dot {
		transition: background-color 0.5s ease;
	}
</style>
<div class="js-slider hidden flex flex-col gap-2">
	<div class="min-w-52 max-w-[800px] relative m-auto">
		<div class="slide">
			<img class="h-80 w-full rounded-xl" src="https://img.freepik.com/premium-photo/cup-coffee-with-smoke-coming-out-it_836919-976.jpg">
		</div>
		<div class="slide">
			<img class="h-80 w-full rounded-xl" src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/health-benefits-of-coffee-main_image_700_350-cf61138.jpg?quality=90&fit=700,350">
		</div>
		<div class="slide">
			<img class="h-80 w-full rounded-xl" src="https://img.freepik.com/premium-photo/cup-coffee-with-coffee-beans-wooden-table-generative-ai_446633-29995.jpg">
		</div>

		<a class="js-previous -left-[50px] cursor-pointer absolute top-[50%] p-2.5 -mt-[25px]">
			<i class="fa fa-chevron-circle-left text-3xl"></i>
		</a>
		<a class="js-next -right-[50px] cursor-pointer absolute top-[50%] p-2.5 -mt-[25px]">
			<i class="fa fa-chevron-circle-right text-3xl"></i>
		</a>
	</div>

	<div class="flex justify-center text-center gap-1">
		<span data-index="1" class="footer-dot cursor-pointer h-4 w-4 bg-gray-200 hover:bg-black rounded-full block"></span>
		<span data-index="2" class="footer-dot cursor-pointer h-4 w-4 bg-gray-200 hover:bg-black rounded-full block"></span>
		<span data-index="3" class="footer-dot cursor-pointer h-4 w-4 bg-gray-200 hover:bg-black rounded-full block"></span>
	</div>
</div>

<script>
	$(document).ready(function () {
		const
			$slider = $(".js-slider"),
			$previous = $slider.find(".js-previous"),
			$next = $slider.find(".js-next"),
			$footerDots = $slider.find(".footer-dot")
		;
		$slider.removeClass("hidden");

		$previous.on("click", function () {
			clearInterval(interval);
			moveSlides(-1);
			interval = setSliderInterval();
		});
		$next.on("click", function () {
			clearInterval(interval);
			moveSlides(1);
			interval = setSliderInterval();
		});
		$footerDots.on("click", function () {
			clearInterval(interval);
			activeSlide($(this).data("index"));
			interval = setInterval(function() {
				moveSlides(1);
			}, 5000);
		});

		let slideIndex = 1;
		displaySlide(slideIndex);

		let interval = setSliderInterval();

		function setSliderInterval() {
			return setInterval(function() {
				moveSlides(1);
			}, 5000);
		}

		function moveSlides(n) {
			displaySlide(slideIndex += n);
		}

		function activeSlide(n) {
			displaySlide(slideIndex = n);
		}

		function displaySlide(n) {
			const
				$totalSlides = $(".slide"),
				$totalDots = $(".footer-dot")
			;
			if (n > $totalSlides.length) {
				slideIndex = 1;
			}
			if (n < 1) {
				slideIndex = $totalSlides.length;
			}
			$totalSlides.addClass("hidden");
			$totalDots.removeClass("!bg-black");
			$totalSlides.eq(slideIndex - 1).removeClass("hidden");
			$totalDots.eq(slideIndex - 1).addClass("!bg-black");
		}
	});
</script>