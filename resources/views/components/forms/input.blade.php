<input 
    
    {{ $attributes->merge(['id' => ($attributes->get('name') . '_inp'), 'class' => 'form-control' . $checkError($attributes->get('name')), 'type' => 'text', 'placeholder' => $attributes->get('placeholder') ?? Str::title(Str::of($attributes->get('name'))->replace('_', ' ')), 'value' => old($attributes->get('name'))]) }}

/>

@error($attributes->get('name')) <div class="small text-danger"> <i class="fa fa-times-circle"></i> {{ $message }}</div> @enderror
