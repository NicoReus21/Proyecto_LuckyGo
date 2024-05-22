@extends('layout.app')

@section('content')
<div class="wrapper" style="background-color: white; padding: 20px;">
    <h2>Sorteadores</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('raffletors.manage.post') }}">
        @csrf
        <div class="raffletor-table" style="background-color: #f0f0f0; padding: 20px; border-radius: 8px;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Edad</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($raffletors as $raffletor)
                    <tr>
                        <td>{{ $raffletor->id }}</td>
                        <td>{{ $raffletor->name }}</td>
                        <td>{{ $raffletor->email }}</td>
                        <td>{{ $raffletor->age }}</td>
                        <td><input type="checkbox" name="raffletor_ids[]" value="{{ $raffletor->id }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-blue">Mandar petición</button>
        </div>
    </form>
</div>
@endsection
