<div>
    <h2>Detalles de tu billete</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha del billete</th>
                <th>Números jugados</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $ticket->created_at }}</td>
                <td>{{ $ticket->content }}</td> <!-- Aquí se muestran los números del ticket -->
            </tr>
        </tbody> 
    </table>

    <h2>Detalles del sorteo</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha del sorteo</th>
                <th>Números ganadores</th>
                @if($raffle->will_be_lucky)
                    <th>Números ganadores "Tendré suerte"</th>
                @endif
            </tr>
        </thead>    
        <tbody>
            <tr>
                <td>{{ $raffle->date }}</td>
                <td>{{ $raffle->winner_number }}</td> <!-- Aquí se muestran los números ganadores -->
                @if($raffle->will_be_lucky)
                    <td>{{ $raffle->will_be_lucky }}</td>
                @endif
            </tr>
        </tbody>
    </table>

    @if(
        ($ticket->content == $raffle->winner_number) ||
        (isset($ticket->is_will_be_luck) && $ticket->is_will_be_luck == $raffle->will_be_lucky)
    )
        <h2>Tienes premio</h2>
    @else
        <h2>Sin premio</h2>
    @endif
</div>
