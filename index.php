<html>
  <head>
    <title>Buscar en tiempo real con ReactJS, PHP, MySQL y Boostrap</title>
    <script src="https://fb.me/react-0.13.3.js"></script>
    <script src="https://fb.me/JSXTransformer-0.13.3.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12" >
          <div id="contenido"></div>

    <script type="text/jsx">
      var SearchBox = React.createClass({
          doSearch:function(){
              var query=this.refs.searchInput.getDOMNode().value; // Este es el buscador de Textos
              this.props.doSearch(query);
          },
          render:function(){
            // Mostramos el input text para Buscar los items
              return <input type="text" className="form-control" ref="searchInput" placeholder="Ingrese el Nombre del Postre que desea Buscar" value={this.props.query} onChange={this.doSearch}/>
          }
      });

      var DisplayTable = React.createClass({
          render:function(){
              //Hacemos que las filas se muestren en la tabla
              var rows=[];
              this.props.data.forEach(function(postre) {
              rows.push(<tr><td>{postre.id}</td><td>{postre.nombre}</td><td>{postre.precio}</td><td>{postre.stock}</td></tr>)
              });
              //Devolvemos la Tabla HTML
              return(
                   <table className="table table-hover table-bordered">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Precio</th>
                              <th>Stock</th>
                          </tr>
                      </thead>
                      <tbody>{rows}</tbody>
                  </table>               
              );
          }
      });

      var InstantBox = React.createClass({
          doSearch:function(queryText){
              console.log(queryText)
              //Obtenemos los resultados
              var queryResult=[];
              this.props.data.forEach(function(postre){
                  if(postre.nombre.toLowerCase().indexOf(queryText)!=-1)
                  queryResult.push(postre);
              });
       
              this.setState({
                  query:queryText,
                  filteredData: queryResult
              })
          },
          getInitialState:function(){
              return{
                  query:'',
                  filteredData: this.props.data
              }
          },
          render:function(){
              return (
                // Renderizamos la tabla HTML, las filas y el frontend de React JS
                  <div className="InstantBox">
                      <h1>Buscar en tiempo real con ReactJS, PHP, MySQL y Boostrap.</h1>
                      <SearchBox query={this.state.query} doSearch={this.doSearch}/>
                      <br/>
                      <DisplayTable data={this.state.filteredData}/>

                      <div className="container text-center">
                        Desarrollado por <a href="http://www.collectivecloudperu.com" target="_blank">Collective Cloud Peru</a>
                      </div>
                  </div>
              );
          }
      });

      <?php

        // Conectamos a la Base de Datos MySQL con PHP e imprimimos los items, cerramos la Conexion por seguridad.

        $mysqli = new mysqli('localhost','collecti','94xo5T2Cvp','collecti_blog');
                      
        if ($mysqli->connect_error) {
            die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }

            $results = $mysqli->query("SELECT id, nombre, precio, stock FROM postres");
                      
            echo "var datosTabla=[";
            while($row = $results->fetch_object()) {
            echo "{";
            echo "id:'".$row->id."',";
            echo "nombre:'". $row->nombre."',";
            echo "precio:'". $row->precio."',";
            echo "stock:'". $row->stock."'},";           
            }

            echo "];";

             $mysqli->close();
       ?>

      // A traves de React JS le indicamos que renderize todo el contenido en las etiquetas HTML <body></body>
      React.render(<InstantBox data={datosTabla}/>,document.body);      

    </script>

    </div>
    </div>
    </div>
  </body>
</html>