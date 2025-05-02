                      <!-- Begin Page Content -->
                      <div class="container-fluid">

                          <!-- Page Heading -->
                          <h1 class="h3 mb-2 text-gray-800">Asistencias</h1>

                          <!-- Filtros -->
                          <form action="" method="POST" id="formAsistencia">
                              <div class="row g-3 align-items-center m-4">
                                  <div class="col-6 col-lg-2 mt-3">
                                      <label for="fecha" class="col-form-label">Selecciona un día</label>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <input type="date" name="fecha" class="form-control">
                                  </div>

                                  <div class="col-6 col-lg-2 mt-3">
                                      <label class="form-label" for="anio">Selecciona un año</label>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <select class="form-control" name="anio">
                                          <option value="">Selecciona un año</option>
                                          <option value="2023">2023</option>
                                          <option value="2024">2024</option>
                                          <option value="2025">2025</option>
                                      </select>
                                  </div>
                                  <div class="col-6 col-lg-2">
                                      <label class="form-label" for="mes">Selecciona un mes</label>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <select class="form-control" name="mes">
                                          <option value="">Selecciona un mes</option>
                                          <option value="1">Enero</option>
                                          <option value="2">Febrero</option>
                                          <option value="3">Marzo</option><!--  -->
                                          <option value="4">Abril</option>
                                          <option value="5">Mayo</option>
                                          <option value="6">Junio</option>
                                          <option value="7">Julio</option>
                                          <option value="8">Agosto</option>
                                          <option value="9">Septiembre</option>
                                          <option value="10">Octubre</option>
                                          <option value="11">Noviembre</option>
                                          <option value="12">Diciembre</option>
                                      </select>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <label for="nombre" class="form-label">Nombre del alumno</label>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <input type="text" name="nombre" class="form-control" placeholder="Ej. Silvany">
                                  </div>


                                  <div class="col-6 col-lg-2 mt-3">
                                      <label for="semana_inicio" class="form-label">Inicio de semana (Lunes)</label>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <input type="date" name="semana_inicio" id="semana_inicio" class="form-control">
                                  </div>

                                  <div class="col-6 col-lg-2 mt-3">
                                      <label for="semana_fin" class="form-label">Fin de semana (Domingo)</label>
                                  </div>
                                  <div class="col-6 col-lg-2 mt-3">
                                      <input type="date" name="semana_fin" id="semana_fin" class="form-control" readonly>
                                  </div>



                                  <div class="col-12 d-flex justify-content-center mt-3">
                                      <button class="btn btn-primary" type="submit">Buscar</button>
                                  </div>
                              </div>
                          </form>


                          <!-- DataTales Example -->
                          <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Lista de Asistencia</h6>

                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                          <thead>
                                              <tr>
                                                  <th>Id</th>
                                                  <th>Nombre</th>
                                                  <th>Fecha</th>
                                                  <th>Hora de entrada</th>
                                                  <th>Hora de salida</th>
                                              </tr>
                                          </thead>
                                          <tfoot>
                                              <tr>
                                                  <th>Id</th>
                                                  <th>Nombre</th>
                                                  <th>Fecha</th>
                                                  <th>Hora de entrada</th>
                                                  <th>Hora de salida</th>
                                              </tr>
                                          </tfoot>
                                          <tbody>
                                              <?php
                                                $asistencias = [];

                                                if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['fecha'])) {
                                                    $asistencias = ControladorAsistencias::ctrBuscarAlumnoDia();
                                                } else if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['mes']) && !empty($_POST['anio'])) {
                                                    $asistencias = ControladorAsistencias::ctrBuscarAlumnoMesAnio();
                                                } else if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['nombre'])) {
                                                    $asistencias = ControladorAsistencias::ctrBuscarAlumnoNombre();
                                                } else if (!empty($_POST['semana_inicio']) && !empty($_POST['semana_fin'])) {
                                                    $asistencias = ControladorAsistencias::ctrBuscarAlumnoSemana();
                                                } else {
                                                    $item = null;
                                                    $campo = null;
                                                    $asistencias = ControladorAsistencias::ctrMostrarAsistencias($item, $campo);
                                                }


                                                if (!empty($asistencias)) {
                                                    foreach ($asistencias as $asistencia):
                                                ?>
                                                      <tr>
                                                          <td><?= $asistencia->id ?></td>
                                                          <td><?= $asistencia->nombre ?></td>
                                                          <td><?= $asistencia->fecha ?></td>
                                                          <td><?= $asistencia->hora_entrada ?></td>
                                                          <td><?= $asistencia->hora_salida ?></td>
                                                      </tr>
                                                  <?php endforeach ?>
                                              <?php } ?>
                                          </tbody>
                                      </table>

                                  </div>
                              </div>
                          </div>

                      </div>
                      <!-- /.container-fluid -->

                      <script>
                          // VALIDAR QUE SE SELECCIONE MES Y AÑO
                          document.getElementById('formAsistencia').addEventListener('submit', function(e) {
                              const fecha = document.querySelector('input[name="fecha"]').value;
                              const mes = document.querySelector('select[name="mes"]').value;
                              const anio = document.querySelector('select[name="anio"]').value;

                              // Si NO hay fecha y SÍ hay mes o año pero están incompletos
                              if (fecha === '') {
                                  if (mes !== '' && anio === '') {
                                      e.preventDefault();
                                      alert("Debes seleccionar el AÑO si vas a filtrar por MES.");
                                  } else if (anio !== '' && mes === '') {
                                      e.preventDefault();
                                      alert("Debes seleccionar el MES si vas a filtrar por AÑO.");
                                  }
                              }
                          });

                          // SELECCIONAR AUTOMATICAMENTE EL DOMINGO DE LA SEMANA
                          document.getElementById('semana_inicio').addEventListener('change', function() {
                              const inicio = new Date(this.value);
                              if (!isNaN(inicio)) {
                                  const domingo = new Date(inicio);
                                  domingo.setDate(inicio.getDate() + 6); // Suma 6 días para llegar al domingo

                                  const yyyy = domingo.getFullYear();
                                  const mm = String(domingo.getMonth() + 1).padStart(2, '0');
                                  const dd = String(domingo.getDate()).padStart(2, '0');

                                  document.getElementById('semana_fin').value = `${yyyy}-${mm}-${dd}`;
                              }
                          });

                          //EXERIMENTAL PARA QUE EL USUARIO DEBA ESCOGER EL DIA LUNES FORZOSAMENTE ANALIZALO
                          document.getElementById('semana_inicio').addEventListener('change', function() {
                              const fecha = new Date(this.value);
                              const dia = fecha.getDay(); // 1 = lunes
                              console.log(dia);
                              if (dia !== 0) {


                                  swal({
                                      type: "eror",
                                      title: "Por favor selecciona un LUNES como inicio de semana.",
                                      showConfirmButton: false,
                                      confirmButtonText: "Cerrar"
                                  });
                                  this.value = ""; // Limpia el campo
                                  document.getElementById('semana_fin').value = ""; // Limpia también el final
                                  return;
                              }

                              // Si es lunes, calcula el domingo
                              const domingo = new Date(fecha);
                              domingo.setDate(fecha.getDate() + 6);

                              const yyyy = domingo.getFullYear();
                              const mm = String(domingo.getMonth() + 1).padStart(2, '0');
                              const dd = String(domingo.getDate()).padStart(2, '0');

                              document.getElementById('semana_fin').value = `${yyyy}-${mm}-${dd}`;
                          });
                      </script>