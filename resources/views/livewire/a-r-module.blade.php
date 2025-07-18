<div>
    <model-viewer class="action quickview" src="{{ $this->productArImage }}" poster="{{ $product->images[0] }}"
        shadow-intensity="1" ar camera-controls touch-action="pan-y" alt="{{ $product->name }}">
    </model-viewer>
</div>

@assets
    <script src="{{ asset('js/model-viewer/main.js') }}" data-navigate-track></script>
@endassets
