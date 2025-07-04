<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTI Asistencias</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Vite (CSS y JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind custom styles -->
    <style>
        .bg-primary {
            background-color: #FF2D20;
        }

        .text-primary {
            color: #FF2D20;
        }

        .custom-shadow {
            box-shadow: 0px 14px 34px rgba(0, 0, 0, 0.08);
        }

        .custom-ring {
            ring: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body class="antialiased font-sans bg-gray-50 text-gray-700 dark:bg-zinc-900 dark:text-white">
    <!-- Barra superior -->
    <div class="flex items-center justify-between h-16 px-6 bg-gray-300 text-white shadow-md">
        <!-- Logo -->
        {{-- <div>
            <x-logo class="w-20 h-17"/>
        </div> --}}

        <!-- Nombre de la Oficina -->
        <div class="flex-1 text-center font-semibold text-xl text-black">
            Oficina de Tecnología e Informática
        </div>

        <!-- Menú de navegación -->
        <div>
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </div>
    </div>

    <!-- Contenedor principal -->
    <div class="bg-gray-100 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <!-- Encabezado secundario -->
                {{-- <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <svg class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg"></svg>
                    </div>
                </header> --}}

                <!-- Formulario de registro -->
                <main class="mt-6 w-full">
                    <div class="flex justify-center">
                        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] dark:bg-zinc-900 dark:ring-zinc-800">
                            <h2 class="text-2xl font-semibold text-center text-black dark:text-white mb-6">Registro de Asistencias</h2>
                            <livewire:asistencias.asistencias-registro />
                        </div>
                    </div>
                </main>

                <!-- Pie de página -->
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Sistema de Asistencias - Oficina de Tecnología e Informática v4.0
                </footer>
            </div>
        </div>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Script para recibir la alerta de Livewire -->
    <script>
        window.addEventListener('swal', event => {
            const { title, text, icon } = event.detail[0]; // Accede a los datos correctamente
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
