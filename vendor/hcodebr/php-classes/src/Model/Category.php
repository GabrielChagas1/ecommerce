<?php 

namespace Hcode\Model;

use \Hcode\Model;
use \Hcode\DB\Sql;

class Category extends Model {

	const SESSION = "User";

	protected $fields = [
		"idcategory", "descategory", "dtregister"
	];

	public static function ListAll(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_categories ORDER BY descategory");
	}

	public function get($idcategory){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_categories WHERE idcategory = :idcategory", array(
			":idcategory" => $idcategory 
		));
		$this->setData($results[0]);
	}

	public function save(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", 
			array(
			":idcategory" => $this->getidcategory(),
			":descategory" => $this->getdescategory()
		));

		$this->setData($results[0]);
		Category::updateFile();
	}

	public function update(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", 
			array(
			":iduser" => $this->getiduser(),
			":desperson" => $this->getdesperson(),
			":deslogin" => $this->getdeslogin(),
			":despassword" => $this->getdespassword(),
			":desemail" => $this->getdesemail(),
			":nrphone" => $this->getnrphone(),
			":inadmin" => $this->getinadmin()
		));

		$this->setData($results[0]);
	}

	public function delete(){
		$sql = new Sql();
		$results = $sql->select("DELETE FROM tb_categories WHERE idcategory = :idcategory", 
			array(
			":idcategory" => $this->getidcategory()
		));
		Category::updateFile();
	}

	public static function updateFile(){
		$categories = Category::ListAll();

		$html = [];

		foreach ($categories as $row) {
			array_push($html, '<li><a href="/categories/'.$row['idcategory'].'">'.$row['descategory'].'</a></li>');
		}
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/views/categories-menu.html" , implode('', $html));
	}

	public function getProducts($related = true){
		$sql = new Sql();
		if($related){
			return $sql->select("SELECT * FROM tb_products WHERE idproduct IN(
				SELECT a.idproduct
					FROM tb_products a 
					INNER JOIN tb_productscategories b ON a.idproduct = b.idproduct
					WHERE b.idcategory = :idcategory
				);
			", [
				':idcategory'=>$this->getidcategory()
			]);
			
		}
		
		return $sql->select("SELECT * FROM tb_products WHERE idproduct  NOT IN(
			SELECT a.idproduct
				FROM tb_products a 
				INNER JOIN tb_productscategories b ON a.idproduct = b.idproduct
				WHERE b.idcategory = :idcategory
			);
		", [
			':idcategory'=>$this->getidcategory()
		]);
	}

	public function addProduct(Product $product){
		$sql = new Sql();
		$sql->query("INSERT INTO tb_productscategories (idcategory, idproduct) VALUES (:idcategory, :idproduct)",[
			':idcategory' => $this->getidcategory(),
			':idproduct' => $product->getidproduct()
		]);
	}

	public function removeProduct(Product $product){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_productscategories WHERE idcategory = :idcategory AND idproduct = :idproduct",[
			':idcategory' => $this->getidcategory(),
			':idproduct' => $product->getidproduct()
		]);
	}

}

?>