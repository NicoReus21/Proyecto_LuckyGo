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
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                            Nombre:
                        </label>
                        <div class="text-gray-500 dark:text-gray-400 mx-auto">{{ Auth::guard('admin')->user()->name }}</div>
                        <!-- Aquí puedes añadir el enlace para cambiar el nombre si es necesario -->
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('update.password.view') }}" class="bg-custom-blue text-white inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Cambiar Contraseña
                        </a>
                    </div>
                </div>
                <br>
            @elseif (Auth::guard('raffletor')->check())
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-black text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                            Nombre actual: {{ Auth::guard('raffletor')->user()->name }}
                        </label>
                        <a href="{{ route('update.name.view') }}" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Cambiar Nombre
                        </a>
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="age">
                            Edad: {{ Auth::guard('raffletor')->user()->age }}
                        </label>
                        <a href="{{ route('update.age.view') }}" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Cambiar Edad
                        </a>
                    </div>
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('update.password.view') }}" class="text-white bg-custom-blue inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Cambiar Contraseña
                        </a>
                    </div>
                </div>
                <br>
                @if (session('error'))
                    <p class="bg-red-500 text-white my-4 rounded-lg text-sm text-center p-2">{{ session('error') }}</p>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
