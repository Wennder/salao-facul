<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-12 17:12
 */
interface AgendamentoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Agendamento 
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
 	 * @param agendamento primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Agendamento agendamento
 	 */
	public function insert($agendamento);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Agendamento agendamento
 	 */
	public function update($agendamento);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByClienteId($value);

	public function queryByDia($value);

	public function queryByInicio($value);

	public function queryByDuracao($value);


	public function deleteByClienteId($value);

	public function deleteByDia($value);

	public function deleteByInicio($value);

	public function deleteByDuracao($value);


}
?>