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
                <form id="frm-example"  method="POST">
                            <table id="tablaUsuarios" class="table-striped table-bordered" style="width:100%">
                                <thead>
                                        <tr>
                                            <th>
                                            <input type="checkbox" id="check"/>
                                            </th>
                                            <th>Documento de Identidad</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>      
                                                
                                        </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <label>Total</label>
                            <input type="text" id="total" class="form-control" readonly value="0.0" />
                </form>
                <button type="button" id="guardar" name="guardar" class="btn m-1 btn-sm btn-success" ><i class="bi bi-save2"></i> Guardar </button>
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
  $(document).ready(function() {
  function crearTabla(datos) {
    let $dt = $('#tablaUsuarios');
    let dt = $dt.DataTable({
      data: datos,
      order: false,
      columns: [{
          render: function(data, type, full, meta) {
            // ACA controlamos la propiedad para des/marcar el input
            return "<input type='checkbox'" + (full.checked ? ' checked' : '') + "/>";
          },
          orderable: false
        },
        {
          data: 'Producto',
          orderable: false
        },
        {
          data: 'Cantidad',
          orderable: false
        },
        {
          data: 'Precio',
          orderable: false
        },
      ]
    });
    let $total = $('#total');

    // Cuando hacen click en el checkbox del thead
    $dt.on('change', 'thead input', function(evt) {
      let checked = this.checked;
      let total = 0;
      let data = [];

      dt.data().each(function(info) {
        // ACA cambiamos el valor de la propiedad
        info.checked = checked;
        // ACA accedemos a las propiedades del objeto
        if (info.checked) total += info.Precio;
        data.push(info);
      });

      dt.clear()
        .rows.add(data)
        .draw();
      $total.val(total);
    });

    // Cuando hacen click en los checkbox del tbody
    $dt.on('change', 'tbody input', function() {
      let info = dt.row($(this).closest('tr')).data();
      let total = parseFloat($total.val());
      // ACA accedemos a las propiedades del objeto
      info.checked = this.checked;
      let price = info.Precio;
      total += info.checked ? price : price * -1;
      $total.val(total);
    });
  }

  crearTabla([{
      "Producto": "Leche",
      "Cantidad": 50,
      "Precio": 3.20
    },
    {
      "Producto": "Azucar",
      "Cantidad": 40,
      "Precio": 2.20
    },
    {
      "Producto": "Gaseosa",
      "Cantidad": 14,
      "Precio": 6.50
    }
  ]);
}); 
</script>
      
      
  </body>
</html>