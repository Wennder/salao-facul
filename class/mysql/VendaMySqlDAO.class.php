<?php
/**
 * Class that operate on table 'venda'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-12 17:12
 */
class VendaMySqlDAO implements VendaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return VendaMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM venda WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM venda';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM venda ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function queryByParam($param) {
		$sql = "SELECT v.* FROM venda v, cliente c WHERE v.cliente_id = c.id AND (c.nome LIKE '%$param%' OR c.username LIKE '%$param%') ORDER BY c.nome";
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param venda primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM venda WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VendaMySql venda
 	 */
	public function insert($venda){
		$sql = 'INSERT INTO venda (cliente_id, data, total, total_pago, obs) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($venda->clienteId);
		$sqlQuery->set($venda->data);
		$sqlQuery->set($venda->total);
		$sqlQuery->set($venda->totalPago);
		$sqlQuery->set($venda->obs);

		$id = $this->executeInsert($sqlQuery);	
		$venda->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param VendaMySql venda
 	 */
	public function update($venda){
		$sql = 'UPDATE venda SET cliente_id = ?, data = ?, total = ?, total_pago = ?, obs = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($venda->clienteId);
		$sqlQuery->set($venda->data);
		$sqlQuery->set($venda->total);
		$sqlQuery->set($venda->totalPago);
		$sqlQuery->set($venda->obs);

		$sqlQuery->setNumber($venda->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM venda';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByClienteId($value){
		$sql = 'SELECT * FROM venda WHERE cliente_id LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByData($value){
		$sql = 'SELECT * FROM venda WHERE data LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTotal($value){
		$sql = 'SELECT * FROM venda WHERE total LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTotalPago($value){
		$sql = 'SELECT * FROM venda WHERE total_pago LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByObs($value){
		$sql = 'SELECT * FROM venda WHERE obs LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByClienteId($value){
		$sql = 'DELETE FROM venda WHERE cliente_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByData($value){
		$sql = 'DELETE FROM venda WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTotal($value){
		$sql = 'DELETE FROM venda WHERE total = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTotalPago($value){
		$sql = 'DELETE FROM venda WHERE total_pago = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByObs($value){
		$sql = 'DELETE FROM venda WHERE obs = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
	 * Read row
	 *
	 * @return VendaMySql 
	 */
	protected function readRow($row){
		$venda = new Venda();
		
		$venda->id = $row['id'];
		$venda->clienteId = $row['cliente_id'];
		$venda->data = $row['data'];
		$venda->total = $row['total'];
		$venda->totalPago = $row['total_pago'];
		$venda->obs = $row['obs'];

		return $venda;
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
	 * @return VendaMySql 
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