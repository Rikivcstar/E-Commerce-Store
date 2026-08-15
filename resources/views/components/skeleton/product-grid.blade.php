@props([
    'count' => 8,
    'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4',
])

<div {{ $attributes->merge(['class' => 'animate-pulse grid ' . $grid]) }} aria-hidden="true">
    @for ($i = 0; $i < $count; $i++)
        <div class="block">
            <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-neutral-200/80"></div>
            <div class="mt-3 space-y-2 px-0.5">
                <div class="h-3.5 w-3/4 rounded-full bg-neutral-200/80"></div>
                <div class="h-3.5 w-1/2 rounded-full bg-neutral-200/80"></div>
                <div class="h-4 w-1/3 rounded-full bg-neutral-200/80"></div>
            </div>
        </div>
    @endfor
</div>