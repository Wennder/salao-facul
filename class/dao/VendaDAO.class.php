<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-12 17:12
 */
interface VendaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Venda 
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
 	 * @param venda primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Venda venda
 	 */
	public function insert($venda);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Venda venda
 	 */
	public function update($venda);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByClienteId($value);

	public function queryByData($value);

	public function queryByTotal($value);

	public function queryByTotalPago($value);

	public function queryByObs($value);
	
	public function queryByParam($param);

	public function deleteByClienteId($value);

	public function deleteByData($value);

	public function deleteByTotal($value);

	public function deleteByTotalPago($value);

	public function deleteByObs($value);


}
?>