<?php
	class Status {
		public $tipo; //ok, erro, aviso
		public $info; //informação adicional
		
		function Status($tipo, $info) {
			$this->tipo = $tipo;
			$this->info = $info;
		}
	}
?>