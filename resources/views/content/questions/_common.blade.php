@if( ! $authUser->isAdmin() )
	@include('content.questions._elements.question_form')
@elseif( empty($questions) )
	<h2>Запитань поки що немає!</h2>
@endif
<div class="flex flex-wrap gap-2">
	@foreach( $questions as $question )
		@include('content.questions._elements.question_card', [
			'id' => $question->id,
			'question' => $question->text,
			'userEmail' => $authUser->isAdmin() ? $question->email : '',
			'date' => $question->date,
			'answer' => $question->answer ?? '',
			'answerDate' => $question->answer_date ?? '',
		])
	@endforeach
</div>