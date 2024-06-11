@extends('layout.app')

@section('content')
<div class="container">
    <h1>Compra de Boletos</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('ticket.purchase.post') }}" method="POST">
        @csrf
        <!-- Aquí puedes agregar campos de formulario según sea necesario -->
        <button type="submit" class="btn btn-primary">Comprar</button>
    </form>
</div>
@endsection
