<?php 
class Alumno extends Conectar{

    public function insert_alumno($usu_id,$no_control,$alu_nom,$alu_ape,$gen_id,$id_carrera,$sem_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO tm_alumno (alu_id, usu_id, no_control, alu_nom, alu_ape, gen_id, id_carrera, sem_id ,fech_crea,estado,est) VALUES (NULL, ?,?,?,?,?,?,?,now(),'Activado','1');";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $no_control);
        $sql->bindValue(3, $alu_nom);
        $sql->bindValue(4, $alu_ape);
        $sql->bindValue(5, $gen_id);
        $sql->bindValue(6, $id_carrera);
        $sql->bindValue(7, $sem_id);

        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function listar_alumno_x_usu($usu_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            tm_alumno.alu_id, 
            tm_alumno.usu_id, 
            tm_alumno.no_control, 
            tm_alumno.alu_nom, 
            tm_alumno.alu_ape, 
            tm_alumno.gen_id, 
            tm_alumno.sem_id, 
            tm_alumno.estado,
            tm_alumno.fech_crea,  
            tm_usuarios.usu_nom, 
            tm_usuarios.usu_ape, 
            tm_genero.gen_nombre, 
            tm_carrera.nom_carrera,
            tm_semestre.sem_nom
            FROM 
            tm_alumno
            INNER join tm_genero on tm_alumno.gen_id = tm_genero.gen_id                 
            INNER join tm_carrera on tm_alumno.id_carrera = tm_carrera.id_carrera 
            INNER join tm_semestre on tm_alumno.sem_id = tm_semestre.sem_id 
            INNER join tm_usuarios on tm_alumno.usu_id = tm_usuarios.usu_id 
            WHERE 
            tm_alumno.est=1
            AND tm_usuarios.usu_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$usu_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    
    public function listar_alumno(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            tm_alumno.alu_id, 
            tm_alumno.usu_id, 
            tm_alumno.no_control, 
            tm_alumno.alu_nom, 
            tm_alumno.alu_ape, 
            tm_alumno.gen_id, 
            tm_alumno.id_carrera, 
            tm_alumno.sem_id, 
            tm_alumno.fech_crea,
            tm_alumno.estado 
            tm_usuarios.usu_nom, 
            tm_usuarios.usu_ape, 
            tm_genero.gen_nombre, 
            tm_carrera.nom_carrera,
            tm_semestre.sem_nom
            FROM 
            tm_alumno
            INNER join tm_genero on tm_alumno.gen_id = tm_genero.gen_id                 
            INNER join tm_carrera on tm_alumno.id_carrera = tm_carrera.id_carrera 
            INNER join tm_semestre on tm_alumno.sem_id = tm_semestre.sem_id 
            INNER join tm_usuarios on tm_alumno.usu_id = tm_usuarios.usu_id 
            WHERE 
            tm_alumno.est=1
            "; 
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function listar_entrada() {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT tm_alumno.alu_id, tm_alumno.no_control, tm_alumno.alu_nom, tm_alumno.alu_ape, td_asistencia2.fecha, td_asistencia2.hora_inicio, td_asistencia2.hora_fin, td_asistencia2.alu_estado
                FROM tm_alumno
                JOIN td_asistencia2 ON tm_alumno.no_control = td_asistencia2.no_control
                WHERE DATE(td_asistencia2.fecha) = CURDATE()";
        
        $sql = $conectar->prepare($sql);
        $sql->execute();
        
        return $resultado = $sql->fetchAll();
    }

    
    public function listar_alumnodetalle($alu_id) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "SELECT 
                    tm_alumno.no_control,
                    tm_alumno.alu_nom,
                    tm_alumno.alu_ape,
                    tm_alumno.fecha_inscripcion, -- Agregamos el campo fecha_inscripcion
                    td_asistencia2.semestre_registrado,
                    td_asistencia2.fecha,
                    td_asistencia2.hora_inicio,
                    td_asistencia2.hora_fin,
                    SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(td_asistencia2.hora_fin, td_asistencia2.hora_inicio)))) AS total_tiempo,
                    (
                        SELECT SEC_TO_TIME(
                            SUM(
                                CASE
                                    WHEN TIME_TO_SEC(TIMEDIFF(t2.hora_fin, t2.hora_inicio)) > TIME_TO_SEC('01:30:00')
                                    THEN TIME_TO_SEC('01:30:00')
                                    ELSE TIME_TO_SEC(TIMEDIFF(t2.hora_fin, t2.hora_inicio))
                                END
                            )
                        )
                        FROM td_asistencia2 AS t2
                        WHERE t2.no_control = tm_alumno.no_control
                        AND t2.semestre_registrado = td_asistencia2.semestre_registrado
                    ) AS total_tiempo_total
                FROM 
                    td_asistencia2
                    INNER JOIN tm_alumno ON td_asistencia2.no_control = tm_alumno.no_control
                WHERE
                    tm_alumno.alu_id = ?
                GROUP BY 
                    tm_alumno.no_control, tm_alumno.alu_nom, tm_alumno.alu_ape, tm_alumno.fecha_inscripcion, td_asistencia2.semestre_registrado, td_asistencia2.fecha, td_asistencia2.hora_inicio, td_asistencia2.hora_fin
                ORDER BY
                    td_asistencia2.semestre_registrado";
    
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $alu_id);
        $sql->execute();
        $resultado = $sql->fetchAll();
    
        return $resultado;
    }
    
    public function delete_alumno($alu_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE tm_alumno 
            SET
            est='0'
            where alu_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $alu_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function desactivar_alumnos(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE tm_alumno 
            SET
            estado='desactivado'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    
    public function update_alumno($alu_id, $no_control, $alu_nom, $alu_ape, $gen_id, $id_carrera, $sem_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_alumno SET 
                    no_control = ?,
                    alu_nom = ?,
                    alu_ape = ?,
                    gen_id = ?,
                    id_carrera = ?,
                    sem_id = ?,
                    estado = 'Activado',
                    fecha_inscripcion = now()
                    WHERE 
                    alu_id = ?
                ";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $no_control);
        $sql->bindValue(2, $alu_nom);
        $sql->bindValue(3, $alu_ape);
        $sql->bindValue(4, $gen_id);
        $sql->bindValue(5, $id_carrera);
        $sql->bindValue(6, $sem_id);
        $sql->bindValue(7, $alu_id);
    
        $sql->execute();
        return $sql->fetchAll();
    }

    public function get_alumno_x_id($alu_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            tm_alumno.alu_id, 
            tm_alumno.usu_id, 
            tm_alumno.no_control, 
            tm_alumno.alu_nom, 
            tm_alumno.alu_ape, 
            tm_alumno.gen_id, 
            tm_alumno.id_carrera, 
            tm_alumno.sem_id, 
            tm_alumno.fech_crea, 
            tm_usuarios.usu_nom, 
            tm_usuarios.usu_ape, 
            tm_genero.gen_nombre, 
            tm_carrera.nom_carrera,
            tm_semestre.sem_nom
        FROM 
            tm_alumno
            INNER JOIN tm_genero ON tm_alumno.gen_id = tm_genero.gen_id                 
            INNER JOIN tm_carrera ON tm_alumno.id_carrera = tm_carrera.id_carrera 
            INNER JOIN tm_semestre ON tm_alumno.sem_id = tm_semestre.sem_id 
            INNER JOIN tm_usuarios ON tm_alumno.usu_id = tm_usuarios.usu_id 
        WHERE 
            tm_alumno.alu_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $alu_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function filtrar_alumno($no_control, $alu_nom, $alu_ape, $gen_id, $id_carrera, $sem_id, $estado) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                    tm_alumno.alu_id, 
                    tm_alumno.no_control, 
                    tm_alumno.alu_nom, 
                    tm_alumno.alu_ape, 
                    tm_alumno.estado, 
                    tm_genero.gen_nombre, 
                    tm_carrera.nom_carrera,
                    tm_semestre.sem_nom
                FROM 
                    tm_alumno
                INNER JOIN tm_genero ON tm_alumno.gen_id = tm_genero.gen_id                 
                INNER JOIN tm_carrera ON tm_alumno.id_carrera = tm_carrera.id_carrera 
                INNER JOIN tm_semestre ON tm_alumno.sem_id = tm_semestre.sem_id 
                WHERE 
                    tm_alumno.est = 1
                    AND (:no_control IS NULL OR tm_alumno.no_control LIKE CONCAT('%', :no_control, '%'))
                    AND (:alu_nom IS NULL OR tm_alumno.alu_nom = :alu_nom)
                    AND (:alu_ape IS NULL OR tm_alumno.alu_ape = :alu_ape)
                    AND (:gen_id IS NULL OR tm_alumno.gen_id = :gen_id)
                    AND (:id_carrera IS NULL OR tm_alumno.id_carrera = :id_carrera)
                    AND (:sem_id IS NULL OR tm_alumno.sem_id = :sem_id)
                    AND (:estado IS NULL OR tm_alumno.estado = :estado)";
    
        $sql = $conectar->prepare($sql);
        $sql->bindValue(':no_control', $no_control !== "" ? $no_control : null);
        $sql->bindValue(':alu_nom', $alu_nom !== "" ? $alu_nom : null);
        $sql->bindValue(':alu_ape', $alu_ape !== "" ? $alu_ape : null);
        $sql->bindValue(':gen_id', $gen_id !== "" ? $gen_id : null);
        $sql->bindValue(':id_carrera', $id_carrera !== "" ? $id_carrera : null);
        $sql->bindValue(':sem_id', $sem_id !== "" ? $sem_id : null);  
        $sql->bindValue(':estado', $estado !== "" ? $estado : null);        
        $sql->execute();
        return $sql->fetchAll();
    }

    public function get_alumno_total(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT COUNT(*) as TOTAL FROM tm_alumno";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_alumno_totalabierto(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT COUNT(*) as TOTAL FROM td_asistencia2 where alu_estado='Entrada'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_alumno_totalcerrado(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT COUNT(*) as TOTAL FROM td_asistencia2 where alu_estado='Salida'";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    } 

    

    
    
        

}
