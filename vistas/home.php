<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tech Logistics</title>
    <link rel="stylesheet" href="css/main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- Bootstrap Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</head>

<body>
    <div id="menu">
        <ul>
            <li>Sesion Activa</li>
            <li class="cerrar-sesion"><a href="includes/logout.php">Cerrar sesión</a></li>
        </ul>
        <h1 class="text">Bienvenido <?php echo $user->getNombre();  ?></h1>
    </div>

    <ul class="nav justify-content-first bg-dark">
        <li class="nav-item">
            <h2 class="nav-link active white">TechLogistics</h2>
        </li>
    </ul>
    <br>

    <!--Boton-->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="text-rigth">
                    <button type="button" class="btn btn-success" onclick="drivers()" data-toggle="modal" data-target="#modalTask">
                        <i class="fas fa-plus-circle"></i> Incidencia
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalIn">
                        <i class="fas fa-times-circle"></i> Inactivos
                    </button>
                </div>
            </div>
            <div class="col">
                <input class="form-control light-table-filter" data-table="order-table" type="text" placeholder="Buscar..">
            </div>
        </div>
    </div>
    <hr class="line-div">
    <!--Fin boton-->

    <!--Busqueda-->
    <!--  Incia tabla -->
    <div class="container">
        <div class="form-group">
            <table class="table table-sm table-bordered text-center order-table">
                <thead class="thead-dark">
                    <tr>
                        <th>Folio</th>
                        <th>Chofer</th>
                        <th></th>
                        <th>Cliente</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th>Estimado</th>
                    </tr>
                </thead>
                <tbody id="loadTable"></tbody>
            </table>
        </div>
    </div>
    <!--Fin tabla-->

    <button class="botonno" id="update">Update</button>


    <!-- Modal 1 -->
    <div class="modal fade" id="modalTask" tabindex="-1" role="dialog" aria-labelledby="modalTask" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTask">Iniciar incidencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Chofer-->
                    <div class="form-group choferSelect">

                        <div id="option"></div>

                        <!--Llenado select-->

                        </select>
                    </div>

                    <!--Fin Chofer-->
                    <div class="form-group">
                        <input type="text" id="client" class="form-control" placeholder="Cliente">
                    </div>

                    <div class="form-group">
                        <input type="text" id="origin" class="form-control" placeholder="Origen">
                    </div>
                    <div class="form-group">
                        <input type="text" id="destiny" class="form-control" placeholder="Destino">
                    </div>

                    <!-- Calendario -->
                    <div class="form-group">
                        <input type="date" name="fecha" class="form-control" id="datePK">
                    </div>

                    <!--Final Calendario-->

                    <div class="form-group">
                        <textarea placeholder="Description" class="form-control" id="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="onClickInsert()">Iniciar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Fin modal-->

    <!-- Modal 2 Info vencidos -->
    <div class="modal fade " id="modalIn" tabindex="-1" role="dialog" aria-labelledby="modalIn" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalIn">Incidencias inactivas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control light-table-filter2" data-table="order-table2" type="text" placeholder="Buscar..">
                    <hr>
                    <!--  Incia tabla -->
                    <div class="container">
                        <div class="form-group">
                            <table class="table table-sm table-bordered text-center order-table2">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Folio</th>
                                        <th>Chofer</th>
                                        <th></th>
                                        <th>Cliente</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Descripcion</th>
                                        <th>Entrega</th>
                                    </tr>
                                </thead>
                                <tbody id="loadTableFin"></tbody>
                            </table>
                        </div>
                    </div>
                    <!--Fin tabla-->


                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Fin modal-->

    <!-- Modal info driver -->
    <div class="modal fade " id="modalDriver" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDriver">Información del chofer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="editData"></div>
                    </div>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>


                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
    </div>

    <!--Fin modal-->

    <!-- Modal documentos -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <div id="image-carousel">

                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveDocuments()">
                            <i class="fas fa-file-download"></i> Descargar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin modal-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://www.gstatic.com/firebasejs/7.14.1/firebase-app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
        <script src="includes/documents.js"></script>
        <script src="includes/jspdf.min.js"></script>
        <script src="includes/firebase.js"></script>
        <script src="includes/logic.js"></script>
        <script src="includes/infoDriver.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>

</body>

</html>