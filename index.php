<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="dni.jpg">
    <title>Consultar por DNI</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
    @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
  </style>
</head>

<body class="font-sans bg-pink-50 text-gray-800 flex flex-col justify-center min-h-screen">
    <div id="preloader_sistema" class="fixed top-0 left-0 h-screen w-full flex items-center justify-center z-50 bg-gray-50 dark:bg-neutral-900 overflow-hidden">
        <div class="lds-ellipsis">
            <div class="bg-pink-900 dark:bg-white"></div>
            <div class="bg-pink-900 dark:bg-white"></div>
            <div class="bg-pink-900 dark:bg-white"></div>
            <div class="bg-pink-900 dark:bg-white"></div>
        </div>
    </div>
    <div class="h-screen w-screen dark:bg-gradient-to-r from-gray-950 via-gray-900 to-gray-950 flex justify-center items-center">
        <div class="mx-5 md:mx-0 shadow-2xl shadow-gray-300 dark:shadow-gray-800 max-w-xl rounded-lg border border-gray-300/40 w-full p-5 flex flex-col gap-4 bg-gray-100 dark:bg-gray-800">
            <div class="w-full h-48 object-contain">
                <img class="h-48 w-full object-contain" src="dni.jpg" alt="">
            </div>
            <div class="flex md:flex-row md:items-center h-10">
                <input placeholder="Ingrese numero de DNI" class="rounded placeholder:text-xs md:placeholder:text-sm especialDNI w-full outline-none bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-full" type="text" name="documentoCli" autocomplete="off" id="documentoCli" value="">
            </div>
            <div class="flex flex-row-reverse space-x-4 space-x-reverse  md:flex-row md:items-center h-10">
            <button class="flex items-center justify-center text-center border border-gray-300 dark:border-gray-600 bg-gray-300 dark:bg-gray-900 h-full rounded w-20" id="especialBuscarPorDNI"><i class="bx bx-search-alt text-gray-900 dark:text-gray-300 font-medium text-xl"></i></button>
            <h1 class="flex items-center">CONSULTAR DNI </h1>
        
        </div>
            <div class="flex flex-col md:flex-row gap-x-4 md:items-center">
                <label for="nombresCli" class="mb-2 text-sm font-medium text-gray-900 dark:text-white md:w-24">Nombres</label>
                <input class="w-full uppercase outline-none bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nombresCli" autocomplete="off" id="nombresCli" disabled>
            </div>
            <div class="flex flex-col md:flex-row gap-x-4 md:items-center">
                <label for="apellidoPaternoCli" class="mb-2 text-sm font-medium text-gray-900 dark:text-white md:w-24">Apellido Paterno</label>
                <input class="w-full uppercase outline-none bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="apellidoPaternoCli" autocomplete="off" id="apellidoPaternoCli" disabled>
            </div>
            <div class="flex flex-col md:flex-row gap-x-4 md:items-center">
                <label for="apellidoMaternoCli" class="mb-2 text-sm font-medium text-gray-900 dark:text-white md:w-24">Apellido Materno</label>
                <input class="w-full uppercase outline-none bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="apellidoMaternoCli" autocomplete="off" id="apellidoMaternoCli" disabled>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            $('#preloader_sistema').fadeOut('slow');

    $(document).on('input', '.especialDNI', function () {
        let inputValue = $(this).val();
        inputValue = inputValue.replace(/[^0-9]/g, '');

        if (inputValue.length > 8) {
            inputValue = inputValue.substr(0, 8);
        }

        $(this).val(inputValue);
    }); 

    $('#especialBuscarPorDNI').on('click', function () {

        let inputValue = $('.especialDNI').val();
            if(inputValue.length < 7){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error: El DNI debe tener 8 digitos.',
                })
                return;
            }else{

        let dni = $('#documentoCli').val();

        $('#nombresCli').val('');
        $('#apellidoPaternoCli').val('');
        $('#apellidoMaternoCli').val('');

        $.ajax({
            url: 'consultar_dni.php', // Cambia la URL a tu archivo PHP
            method: 'GET',
            data: { dni: dni },
            success: function (response) {
                console.log(response);
                if (response.message && response.message === 'not found') {
                    // DNI no encontrado, muestra una alerta
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error: El DNI ingresado no existe.',
                      })
                    return;
                }

                let nombres = response.nombres;
                let apellidoPaterno = response.apellidoPaterno;
                let apellidoMaterno = response.apellidoMaterno;

                // Primero el nombre
                escribirEnInput('#nombresCli', nombres, function () {
                    // Luego el apellido paterno
                    escribirEnInput('#apellidoPaternoCli', apellidoPaterno, function () {
                        // Finalmente el apellido materno
                        escribirEnInput('#apellidoMaternoCli', apellidoMaterno);
                    });
                });
            },
            error: function (error) {
                console.error("ERROR", error);
            }
        });
    }
    });    

    function escribirEnInput(selector, texto, callback) {
        let input = $(selector);
        let i = 0;
        if (texto) { // Verifica si texto no es undefined o null
            let intervalo = setInterval(function () {
                input.val(texto.substring(0, i++));
                if (i > texto.length) {
                    clearInterval(intervalo);
                    if (callback) {
                        callback();
                    }
                }
            }, 150);
        }
    }

    $(document).on('keypress', '.especialDNI', function (e) {
        if(e.key === "Enter") { // Comprueba si la tecla presionada es 'Enter'
            let inputValue = $('.especialDNI').val();
            if(inputValue.length < 7){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error: El DNI debe tener 8 digitos.',
                })
                return;
            }
            else{
                /*  */
                let dni = $('#documentoCli').val();

                $('#nombresCli').val('');
                $('#apellidoPaternoCli').val('');
                $('#apellidoMaternoCli').val('');

                $.ajax({
                    url: '/consultarDNI',
                    method: 'GET',
                    data: { dni: dni },
                    success: function (response) {
                        console.log(response);
                        if (response.message && response.message === 'not found') {
                            // DNI no encontrado, muestra una alerta
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error: El DNI ingresado no existe.',
                            })
                            return;
                        }

                        let nombres = response.nombres;
                        let apellidoPaterno = response.apellidoPaterno;
                        let apellidoMaterno = response.apellidoMaterno;

                        // Primero el nombre
                        escribirEnInput('#nombresCli', nombres, function () {
                            // Luego el apellido paterno
                            escribirEnInput('#apellidoPaternoCli', apellidoPaterno, function () {
                                // Finalmente el apellido materno
                                escribirEnInput('#apellidoMaternoCli', apellidoMaterno);
                            });
                        });
                    },
                    error: function (error) {
                        console.error("ERROR", error);
                    }
                });
                /*  */
            }
        }
    });
        });
    </script>
</body>

</html>