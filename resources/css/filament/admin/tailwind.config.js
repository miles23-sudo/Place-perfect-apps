import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/Customer/**/*.php",
        "./resources/views/filament/admin/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/diogogpinto/filament-auth-ui-enhancer/resources/**/*.blade.php",
        "./vendor/jaocero/activity-timeline/resources/views/**/*.blade.php",
        "./resources/livewire/**/*.blade.php",
    ],
    safelist: [{ pattern: /bg-\[#[0-9A-Fa-f]{6}\]/ }],
};
