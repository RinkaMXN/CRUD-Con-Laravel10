<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- jQuery (Debe ir antes que cualquier script que lo use) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CDN   -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- end Bootstrap CDN   -->

    <!-- Font-Awesome CDN   -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Font-Awesome CDN   -->

    <!-- css personalizado   -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- end css personalizado   -->
</head>
<body>
    @if (session("success"))
    <!-- Modal de Success-->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fa-solid fa-circle-check text-success" style="font-size: 3rem;"> </i>
                    </div>
                    <p class="fw-bold text-success">¡Éxito!</p>
                    <p>{{ session("success") }}</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (session("error"))
    <!-- Modal de Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Encabezado del modal -->
                <div class="modal-header border-0">
                    <!-- Botón para cerrar -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Cuerpo del modal -->
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <!-- Ícono de error -->
                        <i class="fa-solid fa-circle-xmark text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="fw-bold text-danger">¡Error!</p>
                    <p>{{ session("error") }}</p>
                </div>
                <!-- Pie del modal -->
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Rinka</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active icon-size-zoom" aria-current="page" href="/index-libros">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link icon-size-zoom" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle icon-size-zoom" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success icon-size-zoom" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
    @yield('content') 
</body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Mostrar modal de éxito si existe la sesión "correcto"
            @if (session("success"))
                new bootstrap.Modal(document.getElementById('successModal')).show();
            @endif

            // Mostrar modal de error si existe la sesión "incorrecto"
            @if (session("error"))
                new bootstrap.Modal(document.getElementById('errorModal')).show();
            @endif
        });
    </script>
</html>