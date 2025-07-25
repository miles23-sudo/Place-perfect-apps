@assets
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <style src="{{ asset('css/model-viewer.css') }}"></style>
@endassets

<div>
    <model-viewer id="ARviewer" src="{{ asset('storage/' . $this->product->ar_image) }}"
        ios-src="{{ asset('storage/' . $this->product->ar_image_ios) }}" alt="A 3D model of a furniture item" ar
        ar-placement="floor" ar-scale="fixed" ar-modes="scene-viewer quick-look webxr" camera-controls disable-pan
        disable-tap disable-zoom auto-rotate reveal="interaction" shadow-intensity="2" shadow-softness="1"
        max-camera-orbit="auto 90deg auto" touch-action="pan-y" exposure="1" tone-mapping="aces"
        environment-image="neutral" xr-environment slot="canvas">

        <button slot="ar-button" id="ar-button">
            <i class="ion-android-favorite-outline"></i>
            View in your space
        </button>

        <div id="ar-failure"></div>
        <div id="ar-status-message"></div>
        <div id="dimension-label">
            Make sure to place the item on a flat surface.
        </div>
    </model-viewer>
</div>

@script
    <script>
        document.addEventListener('livewire:initialized', () => {
            const viewer = document.querySelector("#ARviewer");
            const arStatusMessage = document.querySelector("#ar-status-message");
            const dimensionLabel = document.querySelector("#dimension-label");

            viewer.addEventListener("ar-tracking", (event) => {
                if (event.detail.status === "not-tracking") {
                    arStatusMessage.textContent = "Searching for a surface...";
                    arStatusMessage.style.display = "block";
                    dimensionLabel.style.display = "none";
                } else {
                    arStatusMessage.style.display = "none";
                    dimensionLabel.style.display = "block";
                }
            });

            viewer.addEventListener("ar-status", (event) => {
                const status = event.detail.status;

                switch (status) {
                    case "not-presenting":
                        arStatusMessage.textContent = "AR session ended.";
                        dimensionLabel.style.display = "none";
                        break;
                    case "session-started":
                        arStatusMessage.innerHTML = `
                        <div id="calibration-animation">📱</div>
                        Move your device slowly to detect a surface.<br>
                        Ensure good lighting and a flat surface.
                    `;
                        arStatusMessage.style.display = "block";
                        break;
                    case "object-placed":
                        arStatusMessage.style.display = "none";
                        dimensionLabel.style.display = "block";
                        break;
                    case "failed":
                        alert("AR session failed. Please try again.");
                        dimensionLabel.style.display = "none";
                        break;
                    default:
                        arStatusMessage.textContent = "Unknown AR status.";
                        break;
                }
            });
        })
    </script>
@endscript
