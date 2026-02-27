@props([
    'label'         => false,
    'placeholder'   => false,
    'type'          => 'text',
    'name'          => 'input_name',
    'value'         => '',
    'resetLink'     => false,
    'disabled'      => false,
    'messages'      => false
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-1']) }}>
     @if($label)
            <label class="form-label font-normal text-gray-900">{{ $label }}</label>
        @endif

         <input {{ $disabled ? 'disabled' : '' }} name="{{ $name }}"
                placeholder="{{ $placeholder }}" type="{{ $type }}" value="{{ $value }}"
         class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10
        dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent
        px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden
        dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">

    @if($messages)
        <x-forms.input-error :messages="$messages" class="mt-1" />
    @endif
</div>

