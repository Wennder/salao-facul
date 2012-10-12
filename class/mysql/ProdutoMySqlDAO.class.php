<?php
/**
 * Class that operate on table 'produto'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-12 17:12
 */
class ProdutoMySqlDAO implements ProdutoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ProdutoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM produto WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM produto';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM produto ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param produto primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM produto WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProdutoMySql produto
 	 */
	public function insert($produto){
		$sql = 'INSERT INTO produto (descricao, qtde_estoque, qtde_ultima_compra, valor_unitario, marca, data) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($produto->descricao);
		$sqlQuery->setNumber($produto->qtdeEstoque);
		$sqlQuery->setNumber($produto->qtdeUltimaCompra);
		$sqlQuery->set($produto->valorUnitario);
		$sqlQuery->set($produto->marca);
		$sqlQuery->set($produto->data);

		$id = $this->executeInsert($sqlQuery);	
		$produto->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProdutoMySql produto
 	 */
	public function update($produto){
		$sql = 'UPDATE produto SET descricao = ?, qtde_estoque = ?, qtde_ultima_compra = ?, valor_unitario = ?, marca = ?, data = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($produto->descricao);
		$sqlQuery->setNumber($produto->qtdeEstoque);
		$sqlQuery->setNumber($produto->qtdeUltimaCompra);
		$sqlQuery->set($produto->valorUnitario);
		$sqlQuery->set($produto->marca);
		$sqlQuery->set($produto->data);

		$sqlQuery->setNumber($produto->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM produto';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDescricao($value){
		$sql = 'SELECT * FROM produto WHERE descricao LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByQtdeEstoque($value){
		$sql = 'SELECT * FROM produto WHERE qtde_estoque LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByQtdeUltimaCompra($value){
		$sql = 'SELECT * FROM produto WHERE qtde_ultima_compra LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByValorUnitario($value){
		$sql = 'SELECT * FROM produto WHERE valor_unitario LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMarca($value){
		$sql = 'SELECT * FROM produto WHERE marca LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByData($value){
		$sql = 'SELECT * FROM produto WHERE data LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescricao($value){
		$sql = 'DELETE FROM produto WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByQtdeEstoque($value){
		$sql = 'DELETE FROM produto WHERE qtde_estoque = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByQtdeUltimaCompra($value){
		$sql = 'DELETE FROM produto WHERE qtde_ultima_compra = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByValorUnitario($value){
		$sql = 'DELETE FROM produto WHERE valor_unitario = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMarca($value){
		$sql = 'DELETE FROM produto WHERE marca = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByData($value){
		$sql = 'DELETE FROM produto WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ProdutoMySql 
	 */
	protected function readRow($row){
		$produto = new Produto();
		
		$produto->id = $row['id'];
		$produto->descricao = $row['descricao'];
		$produto->qtdeEstoque = $row['qtde_estoque'];
		$produto->qtdeUltimaCompra = $row['qtde_ultima_compra'];
		$produto->valorUnitario = $row['valor_unitario'];
		$produto->marca = $row['marca'];
		$produto->data = $row['data'];

		return $produto;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return ProdutoMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>