<?php
class Productos_model {
    private $db;
    private $productos;
    public function __construct($conexion){
        $this->db = $conexion;
        $this->prodcutos = array();
    }
    public function getProducts() {
        $query = "Select 
                p.id,
                p.nom_producto, p.precio, p.disponibilidad, p.ofertas,
                case p.st_producto  
                    when 'A' then 'Activo'
                    when 'I' then 'Inactivo'
                end as estado,
                case p.st_producto  
                    when 'A' then 'success'
                    when 'I' then 'danger'
                end as color_estado,
                c.descripcion as categoria
                from productos p inner join categorias c on
                p.categoria = c.id
                where
                    p.st_producto = 'A' ";
        $statment = $this->db->prepare($query);
        $statment->execute();
        $this->productos = $statment->fetchAll();
        return $this->productos;
    }
    public function getDetailsProduct($cod_empresa, $id){

        $query =  "Select 
                    p.nom_producto, p.precio, p.disponibilidad, p.ofertas,
                    case p.st_producto  
                        when 'A' then 'Activo'
                        when 'I' then 'Inactivo'
                    end as estado,
                    case p.st_producto  
                        when 'A' then 'success'
                        when 'I' then 'danger'
                    end as color_estado,
                    c.descripcion as categoria
                    from productos p inner join categorias c on
                    p.categoria = c.id
                    where 
                        p.cod_empresa = '".$cod_empresa."'
                    and
                        p.st_producto = 'A'
                    and
                        p.id = '".$id."'";
        $statment = $this->db->prepare($query);
        $statment->execute();
        $this->productos = $statment->fetchAll();
        return $this->productos;
    }
    public function insertProduct($nom_product, $precio, $disponibilidad, $ofertas, $categoria){
        $query = "INSERT INTO productos(nom_producto,precio,disponibilidad,ofertas,categoria,st_producto)
                      VALUES('$nom_product','$precio', '$disponibilidad','$ofertas', '$categoria', 'A')";
        try{
            //Iniciamos la transaccion
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->beginTransaction();
            //Ejecutamos el query
            $this->db->exec($query);
            $this->db->commit();
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
            $conexion->rollBack();
            return false;
        }
    }
    public function editProduct($nom_product, $precio, $disponibilidad, $ofertas, $categoria, $id){
        $sql = "UPDATE productos 
                set
                    nom_producto = '".$nom_product."',
                    precio = '".$precio."',
                    disponibilidad = '".$disponibilidad."',
                    ofertas = '".$ofertas."',
                    categoria = '".$categoria."',
                    edited_at =  CURRENT_TIMESTAMP()
                where
                    id = '".$id."'";
        try{
            //Iniciamos la transaccion
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->beginTransaction();
            //Ejecutamos el query
            $this->db->exec($sql);
            $this->db->commit();
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
            $conexion->rollBack();
            return false;
        }
    }
    public function deleteProduct($id){
        $sql = "UPDATE productos 
                set
                    st_producto = 'I',
                    deleted_at =  CURRENT_TIMESTAMP()
                where
                    id = '".$id."'";
        try{
            //Iniciamos la transaccion
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->beginTransaction();
            //Ejecutamos el query
            $this->db->exec($sql);
            $this->db->commit();
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }
}