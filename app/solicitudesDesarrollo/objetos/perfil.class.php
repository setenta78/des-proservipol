<?
Class perfil {
	var $codigoPerfil;
	var $descripcionPerfil;
	var $permisosPerfil = array();
	
	function setCodigoPerfil($codigoPerfil){
		$this->codigoPerfil = $codigoPerfil;
	}
			
	function setDescripcionPerfil($descripcionPerfil){
		$this->descripcionPerfil = $descripcionPerfil;
	}		
	
	function setPermisosPerfil($permisosPerfil){
		$numero = $this->cantidadPermisosPerfil();
		$this->permisosPerfil[$numero] = $permisosPerfil;
	}	
	
	
	function getCodigoPerfil(){
		return $this->codigoPerfil;
	}
	
	function getDescripcionPerfil(){
		return $this->descripcionPerfil;
	}		
	
	function getPermisosPerfil($numero){
		return $this->permisosPerfil[$numero];
	}
	
	
	function cantidadPermisosPerfil(){
		return count($this->permisosPerfil);
	}
	
	function tienePermiso($moduloConsulta, $permisoConsulta){
		$tienePermiso = 0;
		$cantidadPermisos = $this->cantidadPermisosPerfil();
		for ($i=0; $i<$cantidadPermisos; $i++){
			$modulo 	= $this->permisosPerfil[$i]->getModuloPermisoPerfil();
			$permiso 	= $this->permisosPerfil[$i]->getPermiso();
			if ($modulo == $moduloConsulta && $permiso == $permisoConsulta) $tienePermiso = 1;
		}
		
		return $tienePermiso;
	}
	
}//end class   
?>