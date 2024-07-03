@extends('layout.app2')

@section('content')
<div class="pt-28">
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md mx-auto">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Cambiar Nombre</h3>
        </div>
        <div class="p-6 space-y-4">
            <form method="POST" action="{{ route('update.name') }}">
                @csrf
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <input class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" id="name" name="name" placeholder="Ingresa tu nuevo nombre" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <br>
                <button type="submit" class="inline-flex items-center object-right justify-end whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input bg-custom-blue hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3 text-white ml-auto">
                    Guardar cambios
                </button>
                @if (session('message'))
                    <p class="bg-red-500 text-white my-4 rounded-lg text-sm text-center p-2">{{ session('message') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
