@props(['status'])

@php
    $classes = [
        'pending' => 'bg-amber-100 text-amber-800',
        'processing' => 'bg-sky-100 text-sky-800',
        'completed' => 'bg-emerald-100 text-emerald-800',
        'cancelled' => 'bg-red-100 text-red-800',
        'paid' => 'bg-emerald-100 text-emerald-800',
        'unpaid' => 'bg-zinc-200 text-zinc-800',
        'active' => 'bg-emerald-100 text-emerald-800',
        'inactive' => 'bg-zinc-200 text-zinc-800',
    ][$status] ?? 'bg-zinc-200 text-zinc-800';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold uppercase tracking-wide {$classes}"]) }}>
    {{ str_replace('_', ' ', $status) }}
</span>
