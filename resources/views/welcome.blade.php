<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNAM - Registro de Asistencias</title>

    <!-- Fuentes -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Vite (Tailwind CSS + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    <!-- Header institucional con fondo azul oscuro -->
    <header class="bg-[#001F3F] shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-white uppercase tracking-wide">
                Universidad Nacional de Moquegua
            </h1>
            @if (Route::has('login'))
                <div class="text-white">
                    <livewire:welcome.navigation />
                </div>
            @endif
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex items-center justify-center min-h-screen px-4">

            <livewire:asistencias.asistencias-registro />
    </main>

    <!-- Pie de página -->
    <footer class="text-center py-6 text-sm text-gray-500">
        Universidad Nacional de Moquegua &mdash; Oficina de Tecnología e Informática
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Script SweetAlert2 para mensajes Livewire -->
    <script>
        window.addEventListener('swal', event => {
            const { title, text, icon } = event.detail[0];
            Swal.fire({
                title: title || 'Notificación',
                text: text || '',
                icon: icon || 'info',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
</body>
</html>
