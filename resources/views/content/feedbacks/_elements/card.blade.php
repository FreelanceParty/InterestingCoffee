<div class="flex flex-col w-64 lg:w-96 gap-6 border rounded-lg justify-between p-2 bg-amber-100 shadow-xl transition duration-200 ease-in-out hover:scale-105 hover:shadow-2xl cursor-pointer">
	<div>
		{{ $text }}
	</div>
	<div class="flex justify-between w-full border-t border-gray-300">
		<div>
			{{ $user_name }}
		</div>
		<div>
			{{ $created_at }}
		</div>
	</div>
</div>

