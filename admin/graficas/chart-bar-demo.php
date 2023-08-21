<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
  prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
  sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
  dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
  s = '',
  toFixedFix = function(n, prec) {
    var k = Math.pow(10, prec);
    return '' + Math.round(n * k) / k;
  };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
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
      label: "Porcentaje  ",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [
      <?php  
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
      ?>


      ],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 4
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 20,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return  value +'%' ;
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel +  tooltipItem.yLabel +': %' ;
        }
      }
    },
  }
});
</script> 