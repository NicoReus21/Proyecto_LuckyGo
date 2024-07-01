@extends('layout.app2')

@section('content')
<div class="pt-28">
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md mx-auto">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Ajustes de Perfil</h3>
            <p class="text-sm text-muted-foreground">Actualiza tu información personal.</p>
        </div>
        <div class="p-6 space-y-4">
            @if (Auth::guard('admin')->check())
                <form method="POST" action="{{ route('update.password') }}"novalidate>
                <!-- Administrador -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                            Nombre
                        </label>
                        <button type="button" onclick = "toggleInput('name')" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar nombre">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-gray-500 dark:text-gray-400">{{ Auth::guard('admin')->user()->name }}</div>
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="name" placeholder="Ingresa tu nuevo nombre" />
                    </div>
                </div>
                <!-- Contraseña (para administrador) -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label type="button" onclick = "toggleInput('name')" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
                            Contraseña
                        </label>
                        <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar contraseña">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-gray-500 dark:text-gray-400">********</div>
                    </div>
                </div>
                </form>
            @elseif (Auth::guard('raffletor')->check())
                <form method="POST" action="{{ route('update.profile') }}"novalidate>
                <!-- Raffletor -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-black text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                            Nombre actual: {{ Auth::guard('raffletor')->user()->name }}
                        </label>
                        <button type="button" onclick = "toggleInput('name')" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar nombre">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <!--<div class="text-gray-500 dark:text-gray-400">{{ Auth::guard('raffletor')->user()->name }}</div>-->
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="name" placeholder="Ingresa tu nuevo nombre" />
                    </div>
                </div>
                <!-- Edad (para raffletor) -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="age">
                            Edad: {{ Auth::guard('raffletor')->user()->age }}
                        </label>
                        <button type="button" onclick = "toggleInput('age')" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar edad">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="age" placeholder="Ingresa tu nueva edad" type="number" />
                    </div>
                </div>
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
                            Actualizar contraseña
                        </label>
                        <button type="button" onclick = "toggleInput('password')" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar contraseña">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <!--<div class="text-gray-500 dark:text-gray-400">********</div>-->
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="password" placeholder="Ingresa tu nueva contraseña" type="number" />
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="password" placeholder="Respite la contraseña" type="number" />
                    </div>
                </div>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleInput(id) {
        const input = document.getElementById(id);
        if (input.classList.contains('hidden')) {
            input.classList.remove('hidden');
        } else {
            input.classList.add('hidden');
        }
    }
</script>

@endsection
