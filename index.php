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
            <table id="tablaUsuarios" class="table-striped table-bordered" style="width:100%">
                <thead>
                 <tr>
                    <th>
                    <input type="checkbox" id="check" class="dt-checkboxes"/>
                    </th>
                    <th>Documento de Identidad</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>      
                          
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button type="button" id="guardar" name="guardar" class="btn m-1 btn-sm btn-success" disabled><i class="bi bi-save2"></i> Guardar </button>
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
                "url": 'http://www.econt.com.py/ws-unisal/consulta_matriculacion_carrera.php?cbx_sede='+cbx_sede+'&carrera='+carrera+'&curso='+curso+'&turno='+turno+'&alectivo='+alectivo+'',
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

      $(document).ready(function() {

          var cbx_sede = 5;
          var carrera  = 8;
          var curso    = 2;
          var turno    = "TN";
          var alectivo = 2022;
  
    let $dt = $('#tablaUsuarios');
    let dt = $dt.DataTable({
      "ajax":{
                "url": 'http://www.econt.com.py/ws-unisal/consulta_matriculacion_carrera.php?cbx_sede='+cbx_sede+'&carrera='+carrera+'&curso='+curso+'&turno='+turno+'&alectivo='+alectivo+'',
                "dataSrc":""
            },
      columns: [{
          render: function(data, type, full, meta) {
            // ACA controlamos la propiedad para des/marcar el input
            return "<input type='checkbox' class='dt-checkboxes'" + (full.checked ? ' checked' : '') + "/>";
          },
          
        },
        {
          data: 'ci',
          
        },
        {
          data: 'nombre',
          
        },
        {
          data: 'apellido',
          
        },
      ]
    });
    

    $("#guardar").click(function(){
       		
      const myButton = document.getElementById('guardar');
        

        var table = $('#tablaUsuarios').DataTable();
        var data = table.rows( function ( idx, data, node ) {
         return $(node).find('.dt-checkboxes:input[type="checkbox"]').prop('checked');
        }).data().toArray();

        

          table.$('input[type="checkbox"]').each(function() {

          // Si la casilla de verificación está marcada
          if(this.checked){

            $.ajax({
            type: "POST",
            url: "enviar.php",
            data: {valores : JSON.stringify(data) },
            success: function(data)            
            {
              console.log(data);
              guardar.disabled = true;
            }
            });
          };
          });
         
          
         
          /*$.ajax({ myButton.disabled = true;
			    type: "POST",
			    url: "enviar.php",
			    data: {valores : JSON.stringify(data) },
			    success: function(data)            
			    {
            console.log(data); 
			    }
			    });*/
       
			                   

        $('input[type=checkbox]').prop('checked',false);
            
    });

    // Cuando hacen click en el checkbox del thead
    $dt.on('change', 'thead input', function(evt) {
      var checked = this.checked;
      
      var data = [];

        dt.data().each(function(info) {
        // ACA cambiamos el valor de la propiedad
        info.checked = checked;
        // ACA accedemos a las propiedades del objeto

       

        data.push(info);
        
   
        if (info.checked)
        {
          guardar.disabled = false;
        }
        else
        {
          guardar.disabled = true;
        }
        
        console.log(data);
          
        });

        
        dt.clear().rows.add(data).draw();

        
       
    });


    

    

  

    // Cuando hacen click en los checkbox del tbody
    $dt.on('change', 'tbody input', function() {
      let info = dt.row($(this).closest('tr')).data();
      
      // ACA accedemos a las propiedades del objeto
      info.checked = this.checked;
      guardar.disabled = false;
        /*if (info.checked)
        {
          guardar.disabled = false;
        }
        else
        {
          guardar.disabled = true;
        }
      */
      
    });

    /*$('#tablaUsuarios tr').eq(0).each(function () {
            $(this).find('td').each(function () {
                alert($(this).html());
            })
        })*/


       /* $("#guardar").click(function(){
       		$("#tablaUsuarios tr").each(function(){
            $(this).find('td').each(function () {

                var num_cue 	= $(this).find('td').eq(1);
                alert(num_cue);
            })
       		});
    });*/




   /* jQuery('#guardar').on('click', function(e) {
                    e.preventDefault(); //
                        if (document.getElementById('check').checked) 
                	    {
                           
                        alert("Se ha seleccionado por lo menos uno");
                            
                        } 
            		    else 
                		{
                    		alert(" Debes de seleccionar un registro");
                		}
            });
*/


});
    </script>
      
      
  </body>
</html>