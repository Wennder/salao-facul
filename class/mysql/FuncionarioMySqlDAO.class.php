<?php
/**
 * Class that operate on table 'funcionario'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-13 19:48
 */
class FuncionarioMySqlDAO implements FuncionarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return FuncionarioMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM funcionario WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM funcionario';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM funcionario ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param funcionario primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM funcionario WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param FuncionarioMySql funcionario
 	 */
	public function insert($funcionario){
		$sql = 'INSERT INTO funcionario (nome, endereco, cpf, rg, telefone, cargo, data_admissao, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($funcionario->nome);
		$sqlQuery->set($funcionario->endereco);
		$sqlQuery->set($funcionario->cpf);
		$sqlQuery->set($funcionario->rg);
		$sqlQuery->set($funcionario->telefone);
		$sqlQuery->set($funcionario->cargo);
		$sqlQuery->set($funcionario->dataAdmissao);
		$sqlQuery->set($funcionario->obs);

		$id = $this->executeInsert($sqlQuery);	
		$funcionario->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param FuncionarioMySql funcionario
 	 */
	public function update($funcionario){
		$sql = 'UPDATE funcionario SET nome = ?, endereco = ?, cpf = ?, rg = ?, telefone = ?, cargo = ?, data_admissao = ?, obs = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($funcionario->nome);
		$sqlQuery->set($funcionario->endereco);
		$sqlQuery->set($funcionario->cpf);
		$sqlQuery->set($funcionario->rg);
		$sqlQuery->set($funcionario->telefone);
		$sqlQuery->set($funcionario->cargo);
		$sqlQuery->set($funcionario->dataAdmissao);
		$sqlQuery->set($funcionario->obs);

		$sqlQuery->setNumber($funcionario->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM funcionario';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNome($value){
		$sql = 'SELECT * FROM funcionario WHERE nome LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndereco($value){
		$sql = 'SELECT * FROM funcionario WHERE endereco LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCpf($value){
		$sql = 'SELECT * FROM funcionario WHERE cpf LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByRg($value){
		$sql = 'SELECT * FROM funcionario WHERE rg LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTelefone($value){
		$sql = 'SELECT * FROM funcionario WHERE telefone LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCargo($value){
		$sql = 'SELECT * FROM funcionario WHERE cargo LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataAdmissao($value){
		$sql = 'SELECT * FROM funcionario WHERE data_admissao LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByObs($value){
		$sql = 'SELECT * FROM funcionario WHERE obs LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNome($value){
		$sql = 'DELETE FROM funcionario WHERE nome = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndereco($value){
		$sql = 'DELETE FROM funcionario WHERE endereco = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCpf($value){
		$sql = 'DELETE FROM funcionario WHERE cpf = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByRg($value){
		$sql = 'DELETE FROM funcionario WHERE rg = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTelefone($value){
		$sql = 'DELETE FROM funcionario WHERE telefone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCargo($value){
		$sql = 'DELETE FROM funcionario WHERE cargo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataAdmissao($value){
		$sql = 'DELETE FROM funcionario WHERE data_admissao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByObs($value){
		$sql = 'DELETE FROM funcionario WHERE obs = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return FuncionarioMySql 
	 */
	protected function readRow($row){
		$funcionario = new Funcionario();
		
		$funcionario->id = $row['id'];
		$funcionario->nome = $row['nome'];
		$funcionario->endereco = $row['endereco'];
		$funcionario->cpf = $row['cpf'];
		$funcionario->rg = $row['rg'];
		$funcionario->telefone = $row['telefone'];
		$funcionario->cargo = $row['cargo'];
		$funcionario->dataAdmissao = $row['data_admissao'];
		$funcionario->obs = $row['obs'];

		return $funcionario;
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
	 * @return FuncionarioMySql 
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