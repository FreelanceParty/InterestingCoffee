<div class="flex flex-col min-w-28 w-80 h-[400px] border-2 border-gray-300 rounded-lg shadow-xl transition duration-200 ease-in-out hover:scale-105 hover:shadow-2xl cursor-pointer">
	<div class="flex h-2/3 items-center justify-center border-b-2 border-gray-300">
		<img class="w-20 h-20" src="{{ $image }}" alt=''>
	</div>
	<div class="flex flex-col h-1/3 justify-center text-center bg-amber-100 rounded-b-lg">
		<div>
			{{ $title }}
		</div>
		<div>
			{{ $price }}
		</div>
	</div>
</div>