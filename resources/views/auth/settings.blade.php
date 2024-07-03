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
                <form method="POST" action="{{ route('update.profile') }}" novalidate>
                @csrf
                <!-- Administrador -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                            Nombre 
                        </label>
                        <div class="text-gray-500 dark:text-gray-400">{{ Auth::guard('admin')->user()->name }}</div> 
                        <button type="button" onclick="toggleInput('name')" class="bg-custom-blue text-white inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="name" name="name" placeholder="Ingresa tu nuevo nombre" />
                    </div>
                </div>
                <!-- Contraseña (para administrador) -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label type="button" onclick = "toggleInput('name')" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
                            Contraseña
                        </label>
                        <button type="button" onclick="toggleInput('password_inputs')" class="bg-custom-blue text-white inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Editar
                        </button>
                    </div>
                    <div class="flex flex-col space-y-2 hidden" id="password_inputs">
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password" name="password" placeholder="Ingresa tu nueva contraseña" type="password" />
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" type="password" />
                    </div>
                </div>
                <br>

                <button type="submit" class="inline-flex items-center object-right justify-end whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-custom-blue hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3 text-white ml-auto">
                    Guardar cambios
                </button>
                </form>
            @elseif (Auth::guard('raffletor')->check())
                <form method="POST" action="{{ route('update.profile') }}" novalidate>
                @csrf
                <!-- Raffletor -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-black text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                            Nombre actual: {{ Auth::guard('raffletor')->user()->name }}
                        </label>
                        <button type="button" onclick="toggleInput('name')" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="name" name="name" placeholder="Ingresa tu nuevo nombre" />
                    </div>
                </div>
                <!-- Edad (para raffletor) -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="age">
                            Edad: {{ Auth::guard('raffletor')->user()->age }}
                        </label>
                        <button type="button" onclick="toggleInput('age')" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Editar
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="age" name="age" placeholder="Ingresa tu nueva edad" type="number" />
                    </div>
                </div>
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
                            Actualizar contraseña
                        </label>
                        <button type="button" onclick="toggleInput('password_inputs')" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Editar
                        </button>
                    </div>
                    <div class="flex flex-col space-y-2 hidden" id="password_inputs">
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password" name="password" placeholder="Ingresa tu nueva contraseña" type="password" />
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" type="password" />
                    </div>
                </div>
                <br>
                <button type="submit" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:text-accent-foreground h-9 rounded-md px-3 ml-auto">
                    Guardar cambios
                </button>
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
