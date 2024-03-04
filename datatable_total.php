<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!--    Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    <title></title>

    <style>
        table.dataTable thead {
            background: linear-gradient(to right, #4A00E0, #8E2DE2);
            color:white;
        }
    </style>

  </head>
  <body>
    <h2 class="text-center">Alumnos Practicas</h2>
      
    
    
    <div class="container">
       <div class="row">
           <div class="col-lg-12">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

<table class="table table-striped table-bordered" data-page-length='2' id="tbl-buys">
  <thead>
    <tr>
      <th>
        <input type="checkbox" />
      </th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Precio</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <input type="checkbox"/>
      </td>
      <td>Laptop Dell XPS 15</td>
      <td>1</td>
      <td>782.49</td>
    </tr>
    <tr>
      <td>
        <input type="checkbox"/>
      </td>
      <td>Mouse bluetooth solar</td>
      <td>1</td>
      <td>19.90</td>
    </tr>
    <tr>
      <td>
        <input type="checkbox"/>
      </td>
      <td>Sony Headphones 1000px</td>
      <td>1</td>
      <td>29.90</td>
    </tr>
    <tr>
      <td>
        <input type="checkbox"/>
      </td>
      <td>Intel x99</td>
      <td>1</td>
      <td>200.00</td>
    </tr>
  </tbody>
</table>

<label>Total</label>
<input type="text" id="total" class="form-control" readonly value="0.0" />
           </div>
       </div> 
     </div>
   
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
      
<!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
      
      
    <script>
      /*$(document).ready(function() {

          var cbx_sede = 5;
          var carrera  = 8;
          var curso    = 1;
          var turno    = "TN";
          var alectivo = 2022;


          

          $('#tablaUsuarios').DataTable( {
            "ajax":{
                "url": 'consulta_matriculacion_carrera.php?cbx_sede='+cbx_sede+'&carrera='+carrera+'&curso='+curso+'&turno='+turno+'&alectivo='+alectivo+'',
                "dataSrc":""
            },
            "columns":[
                  
              {
          render: function(data, type, full, meta) {
            // ACA controlamos la propiedad para des/marcar el input
            return "<input type='checkbox'" + (full.checked ? ' checked' : '') + "/>";
          },
          orderable: false
        },
                {"data": "ci"},
                {"data": "nombre"},
                {"data": "apellido"},
               
            ]  
          });
      });

*/

$(document).ready(function(){
  let $dt = $('#tbl-buys');
  let dt = $dt.DataTable({
    order:[[1, 'asc']],
    columnDefs: [{
      targets: 0,
      orderable: false
    }]
  });
  let $total = $('#total');
  
  // Cuando hacen click en el checkbox del thead
  $dt.on('change', 'thead input', function (evt) {
    let checked = this.checked;
    let total = 0;
    let data = [];
    
    dt.data().each(function (info) {
      var txt = info[0];
      if (checked) {
        total += parseFloat(info[3]);
        txt = txt.substr(0, txt.length - 1) + ' checked>';
      } else {
        txt = txt.replace(' checked', '');
      }
      info[0] = txt;
      data.push(info);
    });
    
    dt.clear().rows.add(data).draw();
    $total.val(total);
  });
  
  // Cuando hacen click en los checkbox del tbody
  $dt.on('change', 'tbody input', function() {
    let info = dt.row($(this).closest('tr')).data();
    let total = parseFloat($total.val());
    let price = parseFloat(info[3]);
    total += this.checked ? price : price * -1;
    $total.val(total);
  });
});
    </script>
      
      
  </body>
</html>