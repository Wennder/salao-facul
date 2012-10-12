<?php
/**
 * Class that operate on table 'agendamento_servico'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-10 00:17
 */
class AgendamentoServicoMySqlDAO implements AgendamentoServicoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return AgendamentoServicoMySql 
	 */
	public function load($idAgendamento, $idServico){
		$sql = 'SELECT * FROM agendamento_servico WHERE id_agendamento = ?  AND id_servico = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idAgendamento);
		$sqlQuery->setNumber($idServico);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM agendamento_servico';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM agendamento_servico ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param agendamentoServico primary key
 	 */
	public function delete($idAgendamento, $idServico){
		$sql = 'DELETE FROM agendamento_servico WHERE id_agendamento = ?  AND id_servico = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($idAgendamento);
		$sqlQuery->setNumber($idServico);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AgendamentoServicoMySql agendamentoServico
 	 */
	public function insert($agendamentoServico){
		$sql = 'INSERT INTO agendamento_servico ( id_agendamento, id_servico) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($agendamentoServico->idAgendamento);

		$sqlQuery->setNumber($agendamentoServico->idServico);

		$this->executeInsert($sqlQuery);	
		//$agendamentoServico->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param AgendamentoServicoMySql agendamentoServico
 	 */
	public function update($agendamentoServico){
		$sql = 'UPDATE agendamento_servico SET  WHERE id_agendamento = ?  AND id_servico = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($agendamentoServico->idAgendamento);

		$sqlQuery->setNumber($agendamentoServico->idServico);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM agendamento_servico';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return AgendamentoServicoMySql 
	 */
	protected function readRow($row){
		$agendamentoServico = new AgendamentoServico();
		
		$agendamentoServico->idAgendamento = $row['id_agendamento'];
		$agendamentoServico->idServico = $row['id_servico'];

		return $agendamentoServico;
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
	 * @return AgendamentoServicoMySql 
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