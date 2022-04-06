@props(['type', 'message'])

<div class="toast-container" style="position: fixed; right: 2.5rem; top: 2.5rem; z-index: 1500;">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2500">
        <div id="toast-header" class="toast-header bg-{{ App\Helpers\ErrorMessages::color($type) }}">
            {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" class="rounded mr-2" alt="..."> --}}
            <strong id="toast-title" class="mr-auto">
                {{ App\Helpers\ErrorMessages::title($type) }}
            </strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="toast-body" class="toast-body">
            {{ App\Helpers\ErrorMessages::msg($type) }}
        </div>
    </div>
</div>