<?php
/**
 * Class that operate on table 'utensilio'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-09-29 18:01
 */
class UtensilioMySqlDAO implements UtensilioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UtensilioMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM utensilio WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM utensilio';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM utensilio ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param utensilio primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM utensilio WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UtensilioMySql utensilio
 	 */
	public function insert($utensilio){
		$sql = 'INSERT INTO utensilio (descricao, valor, qtde, data_fabricacao, data_recebimento, data_evento, obs) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($utensilio->descricao);
		$sqlQuery->set($utensilio->valor);
		$sqlQuery->setNumber($utensilio->qtde);
		$sqlQuery->set($utensilio->dataFabricacao);
		$sqlQuery->set($utensilio->dataRecebimento);
		$sqlQuery->set($utensilio->dataEvento);
		$sqlQuery->set($utensilio->obs);

		$id = $this->executeInsert($sqlQuery);	
		$utensilio->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UtensilioMySql utensilio
 	 */
	public function update($utensilio){
		$sql = 'UPDATE utensilio SET descricao = ?, valor = ?, qtde = ?, data_fabricacao = ?, data_recebimento = ?, data_evento = ?, obs = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($utensilio->descricao);
		$sqlQuery->set($utensilio->valor);
		$sqlQuery->setNumber($utensilio->qtde);
		$sqlQuery->set($utensilio->dataFabricacao);
		$sqlQuery->set($utensilio->dataRecebimento);
		$sqlQuery->set($utensilio->dataEvento);
		$sqlQuery->set($utensilio->obs);

		$sqlQuery->setNumber($utensilio->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM utensilio';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDescricao($value){
		$sql = 'SELECT * FROM utensilio WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByValor($value){
		$sql = 'SELECT * FROM utensilio WHERE valor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByQtde($value){
		$sql = 'SELECT * FROM utensilio WHERE qtde = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataFabricacao($value){
		$sql = 'SELECT * FROM utensilio WHERE data_fabricacao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataRecebimento($value){
		$sql = 'SELECT * FROM utensilio WHERE data_recebimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataEvento($value){
		$sql = 'SELECT * FROM utensilio WHERE data_evento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByObs($value){
		$sql = 'SELECT * FROM utensilio WHERE obs = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescricao($value){
		$sql = 'DELETE FROM utensilio WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByValor($value){
		$sql = 'DELETE FROM utensilio WHERE valor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByQtde($value){
		$sql = 'DELETE FROM utensilio WHERE qtde = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataFabricacao($value){
		$sql = 'DELETE FROM utensilio WHERE data_fabricacao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataRecebimento($value){
		$sql = 'DELETE FROM utensilio WHERE data_recebimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataEvento($value){
		$sql = 'DELETE FROM utensilio WHERE data_evento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByObs($value){
		$sql = 'DELETE FROM utensilio WHERE obs = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return UtensilioMySql 
	 */
	protected function readRow($row){
		$utensilio = new Utensilio();
		
		$utensilio->id = $row['id'];
		$utensilio->descricao = $row['descricao'];
		$utensilio->valor = $row['valor'];
		$utensilio->qtde = $row['qtde'];
		$utensilio->dataFabricacao = $row['data_fabricacao'];
		$utensilio->dataRecebimento = $row['data_recebimento'];
		$utensilio->dataEvento = $row['data_evento'];
		$utensilio->obs = $row['obs'];

		return $utensilio;
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
	 * @return UtensilioMySql 
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