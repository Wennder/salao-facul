<?php
/**
 * Class that operate on table 'produto_venda'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-13 19:39
 */
class ProdutoVendaMySqlDAO implements ProdutoVendaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ProdutoVendaMySql 
	 */
	public function load($produtoId, $vendaId){
		$sql = 'SELECT * FROM produto_venda WHERE produto_id = ?  AND venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($produtoId);
		$sqlQuery->setNumber($vendaId);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM produto_venda';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM produto_venda ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param produtoVenda primary key
 	 */
	public function delete($produtoId, $vendaId){
		$sql = 'DELETE FROM produto_venda WHERE produto_id = ?  AND venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($produtoId);
		$sqlQuery->setNumber($vendaId);

		return $this->executeUpdate($sqlQuery);
	}
	
	public function queryByVenda($id_venda){
		$sql = 'SELECT * FROM produto_venda WHERE venda_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_venda);
		return $this->getList($sqlQuery);
	}
	
	public function deleteVenda($vendaId){
		$sql = 'DELETE FROM produto_venda WHERE venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($vendaId);
	
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProdutoVendaMySql produtoVenda
 	 */
	public function insert($produtoVenda){
		$sql = 'INSERT INTO produto_venda (qtde, produto_id, venda_id) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($produtoVenda->qtde);

		
		$sqlQuery->setNumber($produtoVenda->produtoId);

		$sqlQuery->setNumber($produtoVenda->vendaId);

		$this->executeInsert($sqlQuery);	
		//$produtoVenda->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProdutoVendaMySql produtoVenda
 	 */
	public function update($produtoVenda){
		$sql = 'UPDATE produto_venda SET qtde = ? WHERE produto_id = ?  AND venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($produtoVenda->qtde);

		
		$sqlQuery->setNumber($produtoVenda->produtoId);

		$sqlQuery->setNumber($produtoVenda->vendaId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM produto_venda';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByQtde($value){
		$sql = 'SELECT * FROM produto_venda WHERE qtde LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByQtde($value){
		$sql = 'DELETE FROM produto_venda WHERE qtde = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ProdutoVendaMySql 
	 */
	protected function readRow($row){
		$produtoVenda = new ProdutoVenda();
		
		$produtoVenda->produtoId = $row['produto_id'];
		$produtoVenda->vendaId = $row['venda_id'];
		$produtoVenda->qtde = $row['qtde'];

		return $produtoVenda;
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
	 * @return ProdutoVendaMySql 
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