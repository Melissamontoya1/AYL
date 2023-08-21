<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [
    <?php 

    $porcentajeciclo = "SELECT * FROM  ciclo ";

    if ($resultciclo = $sqlconnection->query($porcentajeciclo)) {

      if ($resultciclo->num_rows > 0) {
        while($nombrec = $resultciclo->fetch_array(MYSQLI_ASSOC)) {
          $nombre_ciclo=$nombrec['nombre_ciclo'];?>
          '<?php 
          echo $nombre_ciclo;
          ?>',
          <?php 
        }
      }
    }
    ?>
    ],
    datasets: [{
      data: [<?php  
                    $porcentajeeva = "SELECT * FROM  ciclo ";

                    if ($resultevaluacion = $sqlconnection->query($porcentajeeva)) {

                      if ($resultevaluacion->num_rows > 0) {
                        while($nombrec = $resultevaluacion->fetch_array(MYSQLI_ASSOC)) {
                          $id_ciclo=$nombrec['id_ciclo'];

                          $porcentaje_eva='0';
                          $suma2 = "SELECT e.id_evaluacion, e.fecha_evaluacion, e.id_item_estandar_fk, e.justificacion_evaluacion, e.id_creacion_fk, e.estado_evaluacion, sum(e.porcentaje_evaluacion) AS resultado_evaluacion, i.id_item_estandar, i.indice_item_estandar, i.pregunta_item_estandar, i.valor_item_estandar, i.id_ciclo_fk, i.id_categoria_estandar_fk, i.id_subcategoria_estandar_fk,
                          c.id_ciclo, c.nombre_ciclo,
                          cre.id_empresa_fk,cre.id_creacion,cre.fecha_creacion,cre.id_users_fk

                          FROM evaluacion e
                          INNER JOIN item_estandar i 
                          ON e.id_item_estandar_fk=i.id_item_estandar  
                          INNER JOIN ciclo c
                          ON i.id_ciclo_fk = c.id_ciclo
                          INNER JOIN creacion cre
                          ON cre.id_creacion = e.id_creacion_fk
                          WHERE c.id_ciclo='{$id_ciclo}' AND e.estado_evaluacion='completo' AND e.id_creacion_fk='{$id_creacion}' AND cre.id_empresa_fk='{$id_empresa}'
                          ";
                          if ($result3 = $sqlconnection->query($suma2)) {

                            if ($result3->num_rows > 0) {
                              while($reva = $result3->fetch_array(MYSQLI_ASSOC)) {
                                $porcentaje3=$reva['resultado_evaluacion'];
                                  //$rporcentaje=$porcentaje_eva+$porcentaje3;
                                ?>
                                '<?php echo $porcentaje3 ?>',
                                <?php
                              }
                            }
                          }
                        }
                      }
                    }
                    ?>],
      backgroundColor: ['#FF0000', '#0000FF', '#008000','#F1C40F','#E74C3C'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>