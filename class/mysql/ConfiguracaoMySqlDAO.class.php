<?php
/**
 * Class that operate on table 'configuracao'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-04 13:50
 */
class ConfiguracaoMySqlDAO implements ConfiguracaoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ConfiguracaoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM configuracao WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM configuracao';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM configuracao ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param configuracao primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM configuracao WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ConfiguracaoMySql configuracao
 	 */
	public function insert($configuracao){
		$sql = 'INSERT INTO configuracao (nome_empresa, telefone, email, percentual_padrao) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($configuracao->nomeEmpresa);
		$sqlQuery->set($configuracao->telefone);
		$sqlQuery->set($configuracao->email);
		$sqlQuery->set($configuracao->percentualPadrao);

		$id = $this->executeInsert($sqlQuery);	
		$configuracao->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ConfiguracaoMySql configuracao
 	 */
	public function update($configuracao){
		$sql = 'UPDATE configuracao SET nome_empresa = ?, telefone = ?, email = ?, percentual_padrao = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($configuracao->nomeEmpresa);
		$sqlQuery->set($configuracao->telefone);
		$sqlQuery->set($configuracao->email);
		$sqlQuery->set($configuracao->percentualPadrao);

		$sqlQuery->setNumber($configuracao->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM configuracao';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNomeEmpresa($value){
		$sql = 'SELECT * FROM configuracao WHERE nome_empresa LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTelefone($value){
		$sql = 'SELECT * FROM configuracao WHERE telefone LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEmail($value){
		$sql = 'SELECT * FROM configuracao WHERE email LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPercentualPadrao($value){
		$sql = 'SELECT * FROM configuracao WHERE percentual_padrao LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNomeEmpresa($value){
		$sql = 'DELETE FROM configuracao WHERE nome_empresa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTelefone($value){
		$sql = 'DELETE FROM configuracao WHERE telefone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEmail($value){
		$sql = 'DELETE FROM configuracao WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPercentualPadrao($value){
		$sql = 'DELETE FROM configuracao WHERE percentual_padrao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ConfiguracaoMySql 
	 */
	protected function readRow($row){
		$configuracao = new Configuracao();
		
		$configuracao->id = $row['id'];
		$configuracao->nomeEmpresa = $row['nome_empresa'];
		$configuracao->telefone = $row['telefone'];
		$configuracao->email = $row['email'];
		$configuracao->percentualPadrao = $row['percentual_padrao'];

		return $configuracao;
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
	 * @return ConfiguracaoMySql 
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