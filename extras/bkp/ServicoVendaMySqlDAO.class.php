<?php
/**
 * Class that operate on table 'servico_venda'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-13 19:39
 */
class ServicoVendaMySqlDAO implements ServicoVendaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ServicoVendaMySql 
	 */
	public function load($servicoId, $vendaId){
		$sql = 'SELECT * FROM servico_venda WHERE servico_id = ?  AND venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($servicoId);
		$sqlQuery->setNumber($vendaId);

		return $this->getRow($sqlQuery);
	}
	
	public function deleteVenda($vendaId){
		$sql = 'DELETE FROM servico_venda WHERE venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($vendaId);
	
		return $this->executeUpdate($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM servico_venda';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM servico_venda ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function queryByVenda($id_venda){
		$sql = 'SELECT * FROM servico_venda WHERE venda_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id_venda);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param servicoVenda primary key
 	 */
	public function delete($servicoId, $vendaId){
		$sql = 'DELETE FROM servico_venda WHERE servico_id = ?  AND venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($servicoId);
		$sqlQuery->setNumber($vendaId);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ServicoVendaMySql servicoVenda
 	 */
	public function insert($servicoVenda){
		$sql = 'INSERT INTO servico_venda (qtde, servico_id, venda_id) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($servicoVenda->qtde);

		
		$sqlQuery->setNumber($servicoVenda->servicoId);

		$sqlQuery->setNumber($servicoVenda->vendaId);

		$this->executeInsert($sqlQuery);	
		//$servicoVenda->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ServicoVendaMySql servicoVenda
 	 */
	public function update($servicoVenda){
		$sql = 'UPDATE servico_venda SET qtde = ? WHERE servico_id = ?  AND venda_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($servicoVenda->qtde);

		
		$sqlQuery->setNumber($servicoVenda->servicoId);

		$sqlQuery->setNumber($servicoVenda->vendaId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM servico_venda';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByQtde($value){
		$sql = 'SELECT * FROM servico_venda WHERE qtde LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByQtde($value){
		$sql = 'DELETE FROM servico_venda WHERE qtde = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ServicoVendaMySql 
	 */
	protected function readRow($row){
		$servicoVenda = new ServicoVenda();
		
		$servicoVenda->servicoId = $row['servico_id'];
		$servicoVenda->vendaId = $row['venda_id'];
		$servicoVenda->qtde = $row['qtde'];

		return $servicoVenda;
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
	 * @return ServicoVendaMySql 
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