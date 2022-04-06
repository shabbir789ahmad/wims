<div class="form-group">
    <label>
        <i class="fa fa-fw fa-{{ $icon }}"></i>
        {{ Str::title(Str::of($name)->replace('_', ' ')) }} <span class="text-danger">*</span>
    </label>
    <x-forms.input type="text" name="{{ $name }}" required></x-forms.input>
    <x-forms.input type="file" name="{{ $logo }}" required></x-forms.input>
</div>