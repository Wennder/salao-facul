<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-09-28 14:48
 */
interface DespesaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Despesa 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param despesa primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Despesa despesa
 	 */
	public function insert($despesa);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Despesa despesa
 	 */
	public function update($despesa);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTipo($value);

	public function queryByTotal($value);

	public function queryByVencimento($value);

	public function queryByDataSistema($value);


	public function deleteByTipo($value);

	public function deleteByTotal($value);

	public function deleteByVencimento($value);

	public function deleteByDataSistema($value);


}
?>