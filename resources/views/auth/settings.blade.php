@extends('layout.app2')

@section('content')
<div class="pt-28">
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md mx-auto">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Ajustes de Perfil</h3>
            <p class="text-sm text-muted-foreground">Actualiza tu información personal.</p>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                        Nombre
                    </label>
                    <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar nombre">
                        Editar
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-gray-500 dark:text-gray-400">Nombre</div>
                    <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="name" placeholder="Ingresa tu nuevo nombre" />
                </div>
            </div>
            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="age">
                        Edad
                    </label>
                    <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="Editar edad">
                        Editar
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-gray-500 dark:text-gray-400">Edad</div>
                    <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden" id="age" placeholder="Ingresa tu nueva edad" type="number" />
                </div>
            </div>
            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
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
        </div>
    </div>
</div>
   
@endsection
