<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite("resources/css/styleRegister.css")
    <title>Registrar Sorteador</title>
</head>
<body>
    

    <div class="container">
        <div class="tittle">Registrar Sorteador</div>
        <form action="#">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Nombre</span>
                    <input type="name" placeholder="Nombre" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Edad</span>
                    <input type="age" placeholder="Edad" required>
                </div>

                <div class="input-box email">
                    <span class="details">Correo</span>
                    <input type="email" placeholder="email@email.com" required>
                </div>

            </div>

            <div class="button">
            <input type="submit" value="Registrar">
            </div>
            

        </form>
    </div>
    
</body>
</html>