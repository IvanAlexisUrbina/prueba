<?php

include_once '../model/Usuario/UsuarioModel.php';


Class UsuarioController

{ 
    // VISTA DE S
    //consulta capacitaciones que hay vigentes en la bd
    public function consult(){
        $obj= new UsuarioModel();
        $sql="SELECT * FROM capacitacion";
        $capacitaciones=$obj->consult($sql);
       
        include_once '../view/Usuario/capacitaciones/capacitaciones.php';
    }
    
    // la vista de la modal para editar
    public function modalUpdate(){
        $obj=new UsuarioModel();
        $capa_id=$_GET['capa_id'];
        $sql="SELECT * FROM capacitacion
              WHERE capa_id='".$capa_id."'";
             
        $capacitacion=$obj->consult($sql);
        include_once '../view/Usuario/capacitaciones/modalUpdate.php';
    }
    // la vista de la modal para editar
    public function modalDelete(){
        $obj=new UsuarioModel();
        $capa_id=$_GET['capa_id'];
        $sql="SELECT * FROM capacitacion
              WHERE capa_id='".$capa_id."'";
        $capacitacion=$obj->consult($sql);
        include_once '../view/Usuario/capacitaciones/modalDelete.php';
    }


//acciones
    //insertar el capacitacion
     public function CapaInsert(){
        $obj= new UsuarioModel();
        $id=$obj->autoIncrement("capacitacion","capa_id");
        $capa_nombre=$_POST['capa_nombre'];
        $capa_descripcion=$_POST['capa_descripcion'];
        $capa_cupo=$_POST['capa_cupo'];
        $sql="INSERT INTO capacitacion(capa_id,capa_nombre,capa_descripcion,capa_cupo)
              VALUES ($id,'".$capa_nombre."','".$capa_descripcion."','".$capa_cupo."')";
        $update=$obj->insert($sql);
        redirect(getUrl("Usuario","Usuario","consult"));
    }


    //editar el capacitacion
    public function CapaUpdate(){
        $obj= new UsuarioModel();
        $capa_id=$_POST['capa_id'];
        $capa_nombre=$_POST['capa_nombre'];
        $capa_descripcion=$_POST['capa_descripcion'];
        $capa_cupo=$_POST['capa_cupo'];
        $sql="UPDATE capacitacion
              SET  capa_nombre='".$capa_nombre."',capa_descripcion='" . $capa_descripcion . "',capa_cupo='" . $capa_cupo. "'
             WHERE capa_id = '".$capa_id."'";
        $update=$obj->update($sql);
        redirect(getUrl("Usuario","Usuario","consult"));
    }

    //eliminar el Capacitacion
    public function CapaDelete(){
        $obj= new UsuarioModel(); 
        $capa_id=$_POST['capa_id'];
        $sql="DELETE FROM capacitacion
              WHERE capa_id='".$capa_id."'";
        $delete=$obj->delete($sql);
        redirect(getUrl("Usuario","Usuario","consult"));
    }




//////PARA UN USARIO COMUN




    //VISTA DE CUPOS
    public function CuposConsult(){
        $obj= new UsuarioModel();
        $sql="SELECT * FROM capacitacion";
        $capacitaciones=$obj->consult($sql);

        include_once '../view/Usuario/cupos/cupos.php';
        
    }

    public function modalView(){
        $obj= new UsuarioModel();
        $capa_id=$_GET['capa_id'];
        $sql="SELECT tbl_usuario.usu_nombre,tbl_usuario.usu_correo
        FROM tbl_usuario 
        INNER JOIN cupo 
        ON tbl_usuario.usu_id=cupo.usu_id
        WHERE cupo.capa_id=$capa_id";
        $users=$obj->consult($sql);
      
        include_once '../view/Usuario/capacitaciones/viewUsers.php';       
    }




    
    public function CuposInsert(){
        $obj = new UsuarioModel();
        $id = $obj->autoIncrement("cupo","id_cupo");
        $capa_id = $_POST['capa_id'];
        $capa_cantidad = $_POST['cupo_cantidad'];
    
        // Consultar cuántas capacitaciones hay para hacer la resta
        $sql = "SELECT * FROM capacitacion WHERE capa_id='".$capa_id."'";
        $capacitaciones = $obj->consult($sql);
        foreach ($capacitaciones as $capa) {
            $cantidadOld = $capa['capa_cupo'];
            if ($cantidadOld > $capa_cantidad) {
                $nuevacantidad = $cantidadOld - $capa_cantidad;
            } else {
                $nuevacantidad = 0; 
            }
        }
    
        // Verificar si ya existe un registro con el mismo capa_id y usu_id
        $sql = "SELECT * FROM cupo WHERE capa_id='".$capa_id."' AND usu_id='".$_SESSION['idUser']."'";
        $registro = $obj->consult($sql);
        if ($registro->num_rows > 0) {
            echo "<script>alert('Ya estás registrado en esta capacitación');</script>";
            redirect(getUrl("Usuario","Usuario","CuposConsult"));
        } elseif ($nuevacantidad <= 0) {
            echo "<script>alert('No hay cupos disponibles para esta capacitación');</script>";
            redirect(getUrl("Usuario","Usuario","CuposConsult"));
        } else {
            // Actualizar la cantidad de cupos en la capacitación
            $sql = "UPDATE capacitacion SET capa_cupo='" . $nuevacantidad. "' WHERE capa_id='".$capa_id."'";
            $update = $obj->update($sql);
    
            // Insertar el registro en la tabla cupo
            $sql = "INSERT INTO cupo (id_cupo,capa_id,usu_id,capa_cantidad) VALUES ('".$id."','".$capa_id."','".$_SESSION['idUser']."','".$capa_cantidad."')";
            $execute = $obj->insert($sql);
    
            redirect(getUrl("Usuario","Usuario","CuposConsult"));
        }
    }
    
    
    
  
    public function CupoModal(){
        $obj=new UsuarioModel();
        $capa_id=$_GET['capa_id'];
        $sql="SELECT * FROM capacitacion
              WHERE capa_id='".$capa_id."'";
        $capacitacion=$obj->consult($sql);
        include_once '../view/Usuario/cupos/modalCupo.php';
        
    }
}
?>