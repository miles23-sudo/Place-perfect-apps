@props([
    'title' => null,
])

<div class="flex flex-wrap items-center gap-4 bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
    style="background-image:url('{{ asset('sites/img/breadcumb.jpg') }}');">
    <div class="w-full text-center">
        <h2 class="text-white text-8 md:text-[40px] font-normal leading-none text-center">{{ $title }}</h2>
        <ul
            class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>/</li>
            <li class="text-primary">{{ $title }}</li>
        </ul>
    </div>
</div>

<div {{ $attributes->merge(['class' => 's-py-100']) }}>
    <div class="container-fluid">
        {{ $slot }}
    </div>
</div>
