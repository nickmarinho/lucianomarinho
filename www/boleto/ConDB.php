<?php

class MySQL
{
	var $db;
	var $cn;
	
	protected function prepare()
	{
		error_reporting("~E_ALL");
	}
	
	private function conecta($database)
	{
		$this->prepare();
		
		if(!isset($database) || $database == NULL || $database == ""){
			die("Erro: Nenhuma base de dados especificada!");
		}
		
		if(empty($this->db['host'])){
			die("Erro: Nenhum Host definido");
		}elseif(empty($this->db['usuario']) || !isset($this->db['usuario']) || $this->db['usuario'] == ""){
			die("Erro: Nenhum Usuario definido");
		}elseif(!isset($this->db['senha'])){
			die("Erro: Senha inv&aacute;lida");
		}
		$this->cn=mysql_connect($this->db['host'],$this->db['usuario'],$this->db['senha']) or die (mysql_error());
		
		mysql_select_db($database)or die(mysql_error());
		
		return $this->cn;
	}
	
	public function select($database,$tabela,$campos,$limite,$filtro)
	{
		$this->conecta($database);
		
		$retorno = NULL;
		$sql = NULL;
		$sql.= "SELECT ";
		$i=1;
		
		if($campos=="*"){
			$sql.="*";
		}else{
			foreach($campos as $v){
				$sql.=$v;
				if($i!=count($campos)){
					$sql.=",";
					$i++;
				}
			}
		}
		
		$sql.=" FROM `".$tabela."`";
		if(isset($filtro)||$filtro!=""){
			$sql.=" WHERE ".$filtro;
		}
		if(isset($limite)){
			$sql.=" LIMIT ".$limite;
		}
		$exe_sql = mysql_query($sql,$this->cn)or die(mysql_error());
		while($array = mysql_fetch_array($exe_sql)){
			
		}
		$this->fecha();
		return $array;
	}
	
	private function fecha()
	{
		mysql_close($this->cn);
	}
}




// Usage==
$objMySQL = new MySQL;
$objMySQL->db["host"]="localhost";
$objMySQL->db["usuario"]="root";
$objMySQL->db["senha"]="";

$campos = "*";
//select($database,$tabela,$campos,$limite,$filtro)
$busca = $objMySQL->select("teste_boleto","cliente",$campos,10);

?>