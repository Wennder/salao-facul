<?php
/**
 * Class that operate on table 'agendamento'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-13 19:48
 */
class AgendamentoMySqlDAO implements AgendamentoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return AgendamentoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM agendamento WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM agendamento';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function queryBetweenDatas($ini, $fim) {
		$sql = "SELECT * FROM agendamento WHERE dia between '$ini' and '$fim'";
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM agendamento ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param agendamento primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM agendamento WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AgendamentoMySql agendamento
 	 */
	public function insert($agendamento){
		$sql = 'INSERT INTO agendamento (cliente_id, dia, inicio, duracao) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($agendamento->clienteId);
		$sqlQuery->set($agendamento->dia);
		$sqlQuery->set($agendamento->inicio);
		$sqlQuery->set($agendamento->duracao);

		$id = $this->executeInsert($sqlQuery);	
		$agendamento->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param AgendamentoMySql agendamento
 	 */
	public function update($agendamento){
		$sql = 'UPDATE agendamento SET cliente_id = ?, dia = ?, inicio = ?, duracao = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($agendamento->clienteId);
		$sqlQuery->set($agendamento->dia);
		$sqlQuery->set($agendamento->inicio);
		$sqlQuery->set($agendamento->duracao);

		$sqlQuery->setNumber($agendamento->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM agendamento';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByClienteId($value){
		$sql = 'SELECT * FROM agendamento WHERE cliente_id LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDia($value){
		$sql = 'SELECT * FROM agendamento WHERE dia LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}
	
	public function queryByDiaHora($dia, $hora){
		$sql = 'SELECT * FROM agendamento WHERE dia = ? and inicio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($dia);
		$sqlQuery->set($hora);
		return $this->getRow($sqlQuery);
	}
	

	public function queryByInicio($value){
		$sql = 'SELECT * FROM agendamento WHERE inicio LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDuracao($value){
		$sql = 'SELECT * FROM agendamento WHERE duracao LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByClienteId($value){
		$sql = 'DELETE FROM agendamento WHERE cliente_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDia($value){
		$sql = 'DELETE FROM agendamento WHERE dia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInicio($value){
		$sql = 'DELETE FROM agendamento WHERE inicio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDuracao($value){
		$sql = 'DELETE FROM agendamento WHERE duracao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return AgendamentoMySql 
	 */
	protected function readRow($row){
		$agendamento = new Agendamento();
		
		$agendamento->id = $row['id'];
		$agendamento->clienteId = $row['cliente_id'];
		$agendamento->dia = $row['dia'];
		$agendamento->inicio = $row['inicio'];
		$agendamento->duracao = $row['duracao'];

		return $agendamento;
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
	 * @return AgendamentoMySql 
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