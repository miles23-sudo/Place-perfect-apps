<div>
    <div class="flex items-center space-x-1">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $getState())
                <x-ri-star-fill class="w-4 h-4 text-primary-600 fill-current" />
            @else
                <x-ri-star-line class="w-4 h-4 text-primary-400 fill-current" />
            @endif
        @endfor
    </div>
</div>
