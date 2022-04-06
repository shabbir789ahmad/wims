@props(['resource', 'new'])

<div class="alert alert-info" role="alert">
	<h4 class="alert-heading"><i class="fa fa-exclamation-circle"></i>&nbsp;No {{ (new App\Helpers\StringHelper($resource))->ucfirst()->deSnake()->str() }} Found!</h4>
	<p>You have not added any {{ (new App\Helpers\StringHelper($resource))->ucfirst()->deSnake()->str() }} yet!</p>
	<hr>
	<p class="mb-0">Click <a href="{{ route($new) }}">here</a> to add {{ (new App\Helpers\StringHelper($resource))->ucfirst()->deSnake()->str() }}</p>
</div>