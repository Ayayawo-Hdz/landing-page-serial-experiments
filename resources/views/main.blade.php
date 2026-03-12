@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body, .navbar, nav, [class*="nav"] {
            font-family: 'Fira Code', monospace !important;
        }
    </style>
@endpush

<x-layouts.app title="Inicio">
    @yield('content')
</x-layouts.app>