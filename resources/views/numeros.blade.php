<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script>
        var sort;
        var numeros = new Array();

        var i =1;

        while ( i <= 10000) {
            sort=Math.ceil(Math.random()*99999999);
            if(numeros.indexOf(sort) < 0 )
            {
                numeros.push(sort);
                i++;
            }
        }

        console.log(numeros);

        function myFunction() {
            var x =numeros;
            document.getElementById("numeros").innerHTML = x;
        }
    
    </script>
</head>
<body>
<body>

<button onclick="myFunction()">Gerar Números</button>

<p id="numeros"></p><br>

<script>

</script>
</body>
</html>