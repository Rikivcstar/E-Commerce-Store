@props([
    'rows' => 4,
])

<div {{ $attributes->merge(['class' => 'animate-pulse']) }} aria-hidden="true">
    <div class="space-y-3">
        @for ($i = 0; $i < $rows; $i++)
            <div class="flex items-center justify-between">
                <div class="h-3.5 w-24 rounded-full bg-neutral-200/80"></div>
                <div class="h-3.5 w-16 rounded-full bg-neutral-200/80"></div>
            </div>
        @endfor
        <div class="border-t border-neutral-300 pt-3">
            <div class="flex items-center justify-between">
                <div class="h-4 w-20 rounded-full bg-neutral-200/80"></div>
                <div class="h-5 w-24 rounded-full bg-neutral-200/80"></div>
            </div>
        </div>
    </div>
</div>