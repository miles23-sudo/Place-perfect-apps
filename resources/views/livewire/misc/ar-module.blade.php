<div>
    <model-viewer id="ARviewer" src="{{ asset('storage/' . $this->product->ar_image) }}"
        ios-src="{{ asset('storage/' . $this->product->ar_image_ios) }}" alt="A 3D model of a furniture item" ar
        ar-placement="floor" ar-scale="fixed" ar-modes="webxr" camera-controls disable-pan disable-tap disable-zoom
        auto-rotate shadow-intensity="2" shadow-softness="1" max-camera-orbit="auto 90deg auto" exposure="1"
        tone-mapping="aces" environment-image="neutral" xr-environment reveal="auto" poster=""
        touch-action="pan-y" slot="canvas">

        <button slot="ar-button" id="ar-button">
            <i class="ion-android-favorite-outline"></i>
            View in your space
        </button>

        <div id="ar-failure"></div>
        <div id="ar-status-message"></div>

    </model-viewer>
</div>

@assets
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js" defer></script>
    <style>
        model-viewer[ar-tracking="not-tracking"]>#ar-failure {
            height: 100vh;
            width: 100vw;
            box-shadow: inset 0 0 30px 10px rgba(255, 0, 0, 0.8);
        }

        #ar-status-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2rem;
            text-align: center;
            background: rgba(0, 0, 0, 0.75);
            padding: 1rem;
            border-radius: 12px;
            z-index: 100;
            width: 80vw;
            max-width: 90vw;
        }

        #calibration-animation {
            font-size: 3rem;
            margin-top: 1rem;
            animation: tiltPhone 2s infinite ease-in-out;
            transform-origin: center center;
            display: inline-block;
        }

        #dimension-label {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            display: none;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            font-size: 0.8125rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-family: 'Roboto Mono', monospace;
            z-index: 10;
        }

        @keyframes tiltPhone {
            0% {
                transform: rotate(-10deg);
            }

            50% {
                transform: rotate(10deg);
            }

            100% {
                transform: rotate(-10deg);
            }
        }
    </style>
@endassets

@script
    <script type="module">
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
    </script>
@endscript
