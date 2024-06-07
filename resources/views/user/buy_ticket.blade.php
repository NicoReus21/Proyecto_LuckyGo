<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p> seleccione 5 números del 1 al 30 </p>

    <form id="lotteryForm" class="max-w-ml  mx-auto p-6 bg-white">
    @csrf
    <h2> Compra de billetes de lotería </h2>
    <div id="numbers" class="flex flex-wrap justify-center">
    @for ($i = 1; $i <= 30; $i++)
    <div class="number inline-block w-14 h-14m-2 text-center border-2 rounded-full cursor-pointer" data-number="{{$i}}">
    {{$i}}

    </div>
    @endfor
    </div>
    <p class="mt-4"> Billete: $2.000 </p>
    <label class="block mt-2">
    <input type="checkbox" name="category" id="category" value="lucky" class="mt-2"/>
    Categoría "Tendré Suerte" (+$1000)
    </label>
    <p class="mt-4"> Total: <span id="total"> $2000 </span> </p>



    </form>
</body>
</html>