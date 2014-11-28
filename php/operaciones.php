<?php
define("MYSQL_HOST", "localhost"); 
define("MYSQL_USUARIO", "root");   
define("MYSQL_PASSWORD", "root");  

if (isset($_GET['listar'])) {

    $conexion= new mysqli(MYSQL_HOST,MYSQL_USUARIO,MYSQL_PASSWORD,"BD_secuencias");
        if(mysqli_connect_errno()) {
            echo "Error: con la conexion a la DB.";
            exit;
        }

    $sql="select id, name, consensus from TB_motifs";
    $result=$conexion->query($sql);
    $html="<div class=\"col-xs-12\">
    <div class=\"form-group\">  
    <table id=\"tabla_listar\" class=\"table table-striped table-bordered display \" cellspacing=\"0\" width=\"100%\">
        <thead><th> Codigo </th><th> Nombre </th>  <th> Consenso</th></thead>
        <tbody>";
        while ($row = $result->fetch_row()) {
            $html.="<tr>
                        <td>".$row[0]."</td>
                        <td>".$row[1]."</td>
                        <td>".$row[2]."</td>
                    </tr>";
            };

          $html." </tbody></table></div></div>";
          echo $html;
    //echo   json_encode($html);


}else{

    echo "No se puedo listar el contenido";

}













?>