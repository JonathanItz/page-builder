import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Website/**/*.php',
        './resources/views/filament/website/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
