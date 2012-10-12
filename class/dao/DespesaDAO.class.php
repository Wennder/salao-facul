<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-10 00:17
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

	public function queryByMes($value);

	public function queryByAno($value);

	public function queryByTipo($value);

	public function queryByValor($value);

	public function queryByData($value);


	public function deleteByMes($value);

	public function deleteByAno($value);

	public function deleteByTipo($value);

	public function deleteByValor($value);

	public function deleteByData($value);


}
?>