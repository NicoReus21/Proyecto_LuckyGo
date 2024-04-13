<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @vite('resources/css/app.css') --}}
    @vite("resources/css/style.css")
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Inicio Sesion</title>
<body>
    

    <div class="wrapper">

    <form action="">
        <h1>Inicio de Sesion</h1>

        <div class="input-box">
            <label for="email">Ingresar correo electronico</label>
            <input type="correo" placeholder="email@email.com" required>
            <i class='bx bxs-envelope' ></i>
        </div>

        <div class="input-box">
        <label for="email">Ingresar contrasenia</label>
            <input type="contrasenia" placeholder="*********" required>
            <i class='bx bxs-lock-alt'></i>
        </div>

        <button type="submit" class="btn">Entrar</button>

    </form>

    </div>


</body>

</html>