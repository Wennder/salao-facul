<?php
/**
 * Class that operate on table 'despesa'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-09-28 14:48
 */
class DespesaMySqlDAO implements DespesaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return DespesaMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM despesa WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM despesa';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM despesa ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param despesa primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM despesa WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param DespesaMySql despesa
 	 */
	public function insert($despesa){
		$sql = 'INSERT INTO despesa (tipo, total, vencimento, data_sistema) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($despesa->tipo);
		$sqlQuery->set($despesa->total);
		$sqlQuery->set($despesa->vencimento);
		$sqlQuery->set($despesa->dataSistema);

		$id = $this->executeInsert($sqlQuery);	
		$despesa->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param DespesaMySql despesa
 	 */
	public function update($despesa){
		$sql = 'UPDATE despesa SET tipo = ?, total = ?, vencimento = ?, data_sistema = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($despesa->tipo);
		$sqlQuery->set($despesa->total);
		$sqlQuery->set($despesa->vencimento);
		$sqlQuery->set($despesa->dataSistema);

		$sqlQuery->setNumber($despesa->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM despesa';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByTipo($value){
		$sql = 'SELECT * FROM despesa WHERE tipo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTotal($value){
		$sql = 'SELECT * FROM despesa WHERE total = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByVencimento($value){
		$sql = 'SELECT * FROM despesa WHERE vencimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataSistema($value){
		$sql = 'SELECT * FROM despesa WHERE data_sistema = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTipo($value){
		$sql = 'DELETE FROM despesa WHERE tipo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTotal($value){
		$sql = 'DELETE FROM despesa WHERE total = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByVencimento($value){
		$sql = 'DELETE FROM despesa WHERE vencimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataSistema($value){
		$sql = 'DELETE FROM despesa WHERE data_sistema = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return DespesaMySql 
	 */
	protected function readRow($row){
		$despesa = new Despesa();
		
		$despesa->id = $row['id'];
		$despesa->tipo = $row['tipo'];
		$despesa->total = $row['total'];
		$despesa->vencimento = $row['vencimento'];
		$despesa->dataSistema = $row['data_sistema'];

		return $despesa;
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
	 * @return DespesaMySql 
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