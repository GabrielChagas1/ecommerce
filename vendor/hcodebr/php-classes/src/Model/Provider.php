<?php 

namespace Hcode\Model;

use \Hcode\Model;
use \Hcode\DB\Sql;

class Provider extends Model {

	const SESSION = "User";

	protected $fields = [
		"idprovider", "desnamecorporate", "descnpj", "destelephone"
	];

	public function getTotals(){
		$sql = new Sql();

		$rows = $sql->select("SELECT COUNT(*) FROM tb_providers");
		return $rows[0];
	}

	public static function ListAll(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_providers ORDER BY desnamecorporate");
	}

	public function get($idprovider){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_providers WHERE idprovider = :idprovider", array(
			":idprovider" => $idprovider 
		));
		$this->setData($results[0]);
	}

	public function save(){
        $sql = new Sql();
        // var_dump($this->getdestelephone());
        // exit;
		$results = $sql->select("CALL sp_providers_save(:idprovider, :desnamecorporate, :descnpj, :destelephone)", 
			array(
			":idprovider" => $this->getidprovider(),
			":desnamecorporate" => $this->getdesnamecorporate(),
			":descnpj" => $this->getdescnpj(),
			":destelephone" => $this->getdestelephone()
		));

		$this->setData($results[0]);
	}
	public function delete(){
		$sql = new Sql();
		$results = $sql->select("DELETE FROM tb_providers WHERE idprovider = :idprovider", 
			array(
			":idprovider" => $this->getidprovider()
		));
		Category::updateFile();
	}

    

	public static function getPage($page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_providers 
			ORDER BY desnamecorporate
			LIMIT $start, $itemsPerPage;
        ");
        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_providers 
			WHERE desnamecorporate, descnpj, destelephone LIKE :search
			ORDER BY desnamecorporate
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return [
			'data'=>$results,
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];
	}

}

?>