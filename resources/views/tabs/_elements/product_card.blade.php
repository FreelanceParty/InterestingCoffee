<div class="flex flex-col min-w-28 w-40 h-40 border-2 border-gray-300 rounded-lg">
	<div class="flex h-1/2 align-center justify-center border-b-2 border-gray-300">
		<img class="w-20 h-20" src="{{ $image }}" alt=''>
	</div>
	<div class="flex flex-col h-1/2 justify-center text-center">
		<div>
			{{ $title }}
		</div>
		<div>
			{{ $price }} $
		</div>
	</div>
</div>