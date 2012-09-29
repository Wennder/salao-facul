<?php
/**
 * Class that operate on table 'compra'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-09-29 18:01
 */
class CompraMySqlDAO implements CompraDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CompraMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM compra WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM compra';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM compra ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param compra primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM compra WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CompraMySql compra
 	 */
	public function insert($compra){
		$sql = 'INSERT INTO compra (descricao, total, qtde, numero_nota_fiscal, vencimento, nome_representante, data) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($compra->descricao);
		$sqlQuery->set($compra->total);
		$sqlQuery->setNumber($compra->qtde);
		$sqlQuery->set($compra->numeroNotaFiscal);
		$sqlQuery->set($compra->vencimento);
		$sqlQuery->set($compra->nomeRepresentante);
		$sqlQuery->set($compra->data);

		$id = $this->executeInsert($sqlQuery);	
		$compra->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CompraMySql compra
 	 */
	public function update($compra){
		$sql = 'UPDATE compra SET descricao = ?, total = ?, qtde = ?, numero_nota_fiscal = ?, vencimento = ?, nome_representante = ?, data = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($compra->descricao);
		$sqlQuery->set($compra->total);
		$sqlQuery->setNumber($compra->qtde);
		$sqlQuery->set($compra->numeroNotaFiscal);
		$sqlQuery->set($compra->vencimento);
		$sqlQuery->set($compra->nomeRepresentante);
		$sqlQuery->set($compra->data);

		$sqlQuery->setNumber($compra->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM compra';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDescricao($value){
		$sql = 'SELECT * FROM compra WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTotal($value){
		$sql = 'SELECT * FROM compra WHERE total = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByQtde($value){
		$sql = 'SELECT * FROM compra WHERE qtde = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNumeroNotaFiscal($value){
		$sql = 'SELECT * FROM compra WHERE numero_nota_fiscal = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByVencimento($value){
		$sql = 'SELECT * FROM compra WHERE vencimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNomeRepresentante($value){
		$sql = 'SELECT * FROM compra WHERE nome_representante = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByData($value){
		$sql = 'SELECT * FROM compra WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescricao($value){
		$sql = 'DELETE FROM compra WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTotal($value){
		$sql = 'DELETE FROM compra WHERE total = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByQtde($value){
		$sql = 'DELETE FROM compra WHERE qtde = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNumeroNotaFiscal($value){
		$sql = 'DELETE FROM compra WHERE numero_nota_fiscal = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByVencimento($value){
		$sql = 'DELETE FROM compra WHERE vencimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNomeRepresentante($value){
		$sql = 'DELETE FROM compra WHERE nome_representante = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByData($value){
		$sql = 'DELETE FROM compra WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CompraMySql 
	 */
	protected function readRow($row){
		$compra = new Compra();
		
		$compra->id = $row['id'];
		$compra->descricao = $row['descricao'];
		$compra->total = $row['total'];
		$compra->qtde = $row['qtde'];
		$compra->numeroNotaFiscal = $row['numero_nota_fiscal'];
		$compra->vencimento = $row['vencimento'];
		$compra->nomeRepresentante = $row['nome_representante'];
		$compra->data = $row['data'];

		return $compra;
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
	 * @return CompraMySql 
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