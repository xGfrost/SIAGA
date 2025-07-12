<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SIAGA</title>

    @vite('resources/css/app.css')
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.1/dist/chartjs-plugin-zoom.min.js"></script>
</head>

<body>
    @livewireStyles
    @livewire('measurement')

    @livewireScripts
    @stack('scripts')
</body>

</html>
