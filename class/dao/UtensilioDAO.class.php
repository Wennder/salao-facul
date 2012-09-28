<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-09-28 14:48
 */
interface UtensilioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Utensilio 
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
 	 * @param utensilio primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Utensilio utensilio
 	 */
	public function insert($utensilio);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Utensilio utensilio
 	 */
	public function update($utensilio);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDescricao($value);

	public function queryByValor($value);

	public function queryByQtde($value);

	public function queryByDataFabricacao($value);

	public function queryByDataRecebimento($value);

	public function queryByDataEvento($value);

	public function queryByObs($value);


	public function deleteByDescricao($value);

	public function deleteByValor($value);

	public function deleteByQtde($value);

	public function deleteByDataFabricacao($value);

	public function deleteByDataRecebimento($value);

	public function deleteByDataEvento($value);

	public function deleteByObs($value);


}
?>