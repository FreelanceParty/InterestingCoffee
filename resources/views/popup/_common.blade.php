<div id="popup" class="flex justify-center items-center absolute w-full h-screen bg-black bg-opacity-50 z-50 hidden">
	<div class="flex flex-col min-w-fit w-fit max-w-[90%] py-2 px-4 gap-5 h-fit bg-white rounded-lg shadow-lg bg-opacity-100">
		<div class="flex items-center justify-between h-10">
			<div class="js-popup-header-text text-2xl">{{ $headerText ?? '' }}</div>
			<i class="js-popup-close ml-auto fa-sharp fa-solid fa-window-close fa-xl cursor-pointer"></i>
		</div>
		<div class="js-popup-content py-2">
			{{ $content ?? '' }}
		</div>
	</div>
</div>