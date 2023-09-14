<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
$tiempoExpiracion = 20; //2h
if (!isset($_SESSION['usuario'])) {
    $_SESSION['tiempoInicio'] = time();
    $_SESSION['usuario'] = $_POST['username'];
}
$tiempoInicio = isset($_SESSION['tiempoInicio']) ? $_SESSION['tiempoInicio'] : $_SERVER['REQUEST_TIME'];
$tiempoTranscurrido = time() - $tiempoInicio;
$tiempoRestante = $tiempoExpiracion - $tiempoTranscurrido;
if ($tiempoRestante <= 0) {
    $mostrarAlerta = true;
    $tiempoRestante = 0;
    unset($_SESSION['tiempoInicio']);
}
$_SESSION['tiempoInicio'] = $tiempoInicio;
echo "Tiempo restante: <span id='tiempo-restante'>" . $tiempoRestante . "</span> seg.<br>";
?>


<div class="progress"></div>
<span id="tiempo-restante"></span>
</div>
<script>
    <?php if (isset($mostrarAlerta) && $mostrarAlerta) { ?>
        Swal.fire({
            title: 'Alerta',
            text: 'La sesión está por expirar',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Cerrar sesión',
            cancelButtonText: 'Continuar',
            timer: 10000, // Convertir segundos a milisegundos
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        }).then(function (result) {
            if (result.isConfirmed) {
                Swal.fire('La sesión ha expirado').then(function () {
                    icon: 'warning',
                    location.href = 'logout.php';
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('¡Inicie sesión!', 'Es por su seguridad 🤫', 'info').then(function () {
                    location.href = 'login2.php';
                });
            }
            if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href = 'logout.php';
            }
        });
    <?php } ?>

    function actualizarTiempoRestante() {
        var tiempoRestante = parseInt(document.getElementById('tiempo-restante').textContent);
        if (tiempoRestante > 0) {
            tiempoRestante--;
            document.getElementById('tiempo-restante').textContent = tiempoRestante;

            var progreso = 100 - (tiempoRestante * 100 / <?php echo $tiempoExpiracion ?>);
            var progressElement = document.querySelector('.progress');
            progressElement.style.transform = `scaleY(${progreso / 100})`;

        }

        if (tiempoRestante <= 0) {
            var progressElement = document.querySelector('.progress');
            progressElement.style.transform = 'scaleY(0)';
            Swal.fire({
                title: 'Alerta',
                text: 'La sesión ha expirado',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Cerrar sesión',
                cancelButtonText: 'Continuar',
                timer: 10000, // Convertir segundos a milisegundos
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }).then(function (result) {
                if (result.isConfirmed) {
                    Swal.fire('La sesión ha expirado').then(function () {
                        icon: 'warning',
                        location.href = 'logout.php';
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('¡Inicie sesión!', 'Es por su seguridad 🤫', 'info').then(function () {
                        location.href = 'login2.php';
                    });
                }
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = 'logout.php';
                }
            });
        }
    }



    actualizarTiempoRestante();
    var intervalId = setInterval(function () {
        actualizarTiempoRestante();
        var tiempoRestante = parseInt(document.getElementById('tiempo-restante').textContent);
        if (tiempoRestante <= 0) {
            clearInterval(intervalId);
        }
    }, 1000);
</script>