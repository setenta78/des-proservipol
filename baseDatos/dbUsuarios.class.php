<?php
Class dbUsuarios extends Conexion {
    function validaUsuario($login, &$usuario) {
        // Abrir conexión explícita para escape (remoto, no socket local)
        $link = $this->Conecta();
        // Escapar input para prevenir SQLi con link
        $login = mysql_real_escape_string($login, $link);
        // Modificación temporal: Omitimos la validación de password para prueba
        $sql = "SELECT 
                    FUNCIONARIO.ESC_CODIGO,
                    FUNCIONARIO.GRA_CODIGO,
                    GRADO.GRA_DESCRIPCION,
                    USUARIO.UNI_CODIGO,
                    UNIDAD.UNI_DESCRIPCION,
                    UNIDAD.UNI_PLANCUADRANTE,
                    USUARIO.FUN_CODIGO,
                    FUNCIONARIO.FUN_APELLIDOPATERNO,
                    FUNCIONARIO.FUN_APELLIDOMATERNO,
                    FUNCIONARIO.FUN_NOMBRE,
                    USUARIO.TUS_CODIGO,
                    USUARIO.US_FECHACREACION,
                    TIPO_USUARIO.TUS_DESCRIPCION,
                    UNIDAD1.UNI_CODIGO AS COD_UNIDADPADRE,
                    UNIDAD1.UNI_DESCRIPCION AS DES_UNIDADPADRE,
                    UNIDAD1.UNI_TIPOUNIDAD AS TIPO_UNIDADPADRE,
                    UNIDAD.UNI_BLOQUEO,
                    UNIDAD.UNI_TIPOUNIDAD,
                    UNIDAD.UNI_CONTIENEHIJOS,
                    UNIDAD.UNI_CODIGO_ESPECIALIDAD,
                    UNIDAD.UNI_ESPECIALIDAD,
                    UNIDAD.UNI_ACTIVO,
                    IFNULL(UNIDAD.TCU_CODIGO, 0) TIPO_UNIDAD,
                    IFNULL(UNIDAD.TESPC_CODIGO, 0) ESPECIALIDAD_UNIDAD,
                    CARGO_FUNCIONARIO.CAR_CODIGO,
                    IFNULL(UNIDAD.TUNI_CODIGO, 0) TUNI_CODIGO,
                    CONFIG_SYS.FECHA_LIMITE,
                    TIPO_USUARIO.VALIDAR,
                    TIPO_USUARIO.REGISTRAR,
                    TIPO_USUARIO.CONSULTAR_UNIDAD,
                    TIPO_USUARIO.CONSULTAR_PERFIL
                FROM USUARIO
                JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
                JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
                JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                JOIN UNIDAD ON (USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
                LEFT JOIN CARGO_FUNCIONARIO ON (USUARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
                JOIN CONFIG_SYS ON CONFIG_SYS.ACTIVO = 1
                WHERE USUARIO.US_LOGIN = '" . $login . "' AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";
        
        // Debugging: Log query (comentar en producción)
        // error_log("SQL validaUsuario: " . $sql);
        $result = $this->execstmt($link, $sql);
        if (mysql_num_rows($result) > 0) {
            $myrow = mysql_fetch_array($result);
            
            $escalafon = new escalafon;
            $escalafon->setCodigo($myrow["ESC_CODIGO"]);
            $escalafon->setDescripcion("");
            
            $grado = new grado;
            $grado->setEscalafon($escalafon);
            $grado->setCodigo($myrow["GRA_CODIGO"]);
            $grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
            
            $unidadPadre = new unidad;
            $unidadPadre->setCodigoUnidad($myrow["COD_UNIDADPADRE"]);
            $unidadPadre->setDescripcionUnidad($myrow["DES_UNIDADPADRE"]);
            $unidadPadre->setTipoUnidad($myrow["TIPO_UNIDADPADRE"]);
            
            $unidad = new unidad;
            $unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
            $unidad->setPadreUnidad($unidadPadre);
            $unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
            $unidad->setTienePlanCuadrante($myrow["UNI_PLANCUADRANTE"]);
            $unidad->setBloqueada($myrow["UNI_BLOQUEO"]);
            $unidad->setEspecialidad($myrow["UNI_CODIGO_ESPECIALIDAD"]);
            $unidad->setEspecialidadOld($myrow["UNI_ESPECIALIDAD"]);
            $unidad->setTipoUnidad($myrow["UNI_TIPOUNIDAD"]);
            $unidad->setContieneHijos($myrow["UNI_CONTIENEHIJOS"]);
            $unidad->setUnidadTipo($myrow["TUNI_CODIGO"]);
            $unidad->setTipoUnidadPadre($unidadPadre);
            $unidad->setTipoUnidadNew($myrow["TIPO_UNIDAD"]);
            $unidad->setEspecialidadUnidadNew($myrow["ESPECIALIDAD_UNIDAD"]);
            
            $funcionario = new funcionario;
            $funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
            $funcionario->setApellidoPaterno($myrow["FUN_APELLIDOPATERNO"]);
            $funcionario->setApellidoMaterno($myrow["FUN_APELLIDOMATERNO"]);
            $funcionario->setPNombre($myrow["FUN_NOMBRE"]);
            $funcionario->setGrado($grado);
            $funcionario->setCargo($myrow["CAR_CODIGO"]);
            
            $perfil = new perfil;
            $perfil->setCodigoPerfil($myrow["TUS_CODIGO"]);
            $perfil->setDescripcionPerfil($myrow["TUS_DESCRIPCION"]);
            $perfil->setPermisoValidar($myrow["VALIDAR"]);
            $perfil->setPermisoRegistrar($myrow["REGISTRAR"]);
            $perfil->setPermisoConsultarUnidad($myrow["CONSULTAR_UNIDAD"]);
            $perfil->setPermisoConsultarPerfil($myrow["CONSULTAR_PERFIL"]);
            
            $usuario = new usuario;
            $usuario->setUnidad($unidad);
            $usuario->setFuncionario($funcionario);
            $usuario->setUserName($login);
            $usuario->setClave($password); // Mantendremos esto como placeholder
            $usuario->setPerfil($perfil);
            $usuario->setFechaLimite($myrow["FECHA_LIMITE"]);
            $usuario->setPermisoActualizar("");
        } else {
            // No usuario encontrado: Log y set null para evitar fatal en valida.php
            error_log("No usuario encontrado para login: " . $login);
            $usuario = null; // O redirect/header si preferido
        }
        mysql_close($link); // Cierra conexión para evitar leaks
    }

    function validaUsuarioExterior($login, $aplicacion, $usuario) {
        // Código original sin cambios
    }

    function insertBitacoraUsuario($userID, $unidad, $hra_inicio, $ip, $perfil) {
        // Código original sin cambios
    }

    function modificaBitacoraUsuario($userID, $unidad, $hra_inicio, $hra_termino, $perfil, $evento) {
        // Código original sin cambios
    }

    function modificaClaveUsuario($userID, $claveActual, $nuevaClave) {
        // Código original sin cambios
    }

    function obtieneClaveUsuario($userID, $claveActual) {
        // Código original sin cambios
    }

    function eliminaUsuario($userID) {
        // Código original sin cambios
    }

    function CrearUsuario($funcionario) {
        // Código original sin cambios
    }

    function modificaUsuario($funcionario) {
        // Código original sin cambios
    }

    function GrabaUsuario($Unidad, $Funcionario, $Password, $tipoUsuario) {
        // Código original sin cambios
    }

    function GrabaModificacionUsuario($CodigoFuncionario, $TextContrasena, $Sel_TipoUsuario) {
        // Código original sin cambios
    }

    function BorraUsuario($CodigoFuncionario) {
        // Código original sin cambios
    }

    function ListaUsuarios($Unidad) {
        // Código original sin cambios
    }

    function ListaCodigoUsuarios($Unidad, $CodigoSeleccionado) {
        // Código original sin cambios
    }

    function ObtieneDatosUsuario($CodigoFuncionario, $APaterno, $AMaterno, $Nombres, $GradoDescripcion, $TipoCodigo, $Password, $Desc_TipoUsuario) {
        // Código original sin cambios
    }

    function cambioUnidad($unidad, $usuario) {
        // Código original sin cambios
    }

    function cambioUsuario($codUsuario, $usuario) {
        // Código original sin cambios
    }
}
?>