@props([
'label' => '',
'type' => 'text',
'name' => null
])

<div class="space-y-2">
    <label class="block text-sm font-medium tracking-wide text-slate-300">
        {{ $label }}
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name ?? Str::slug($label, '_') }}"
        placeholder="{{ $label }}"
        {{ $attributes }}
        class="w-full rounded-xl
               bg-black/40 backdrop-blur
               border border-white/10
               px-4 py-3
               text-slate-100 placeholder-slate-500
               shadow-inner
               transition-all duration-200
               focus:outline-none
               focus:border-amber-400
               focus:ring-2 focus:ring-amber-400/30
               hover:border-amber-300/60">
</div>