<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-09-29 13:45
 */
interface UsuarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Usuario 
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
 	 * @param usuario primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Usuario usuario
 	 */
	public function insert($usuario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Usuario usuario
 	 */
	public function update($usuario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNome($value);

	public function queryByUsername($value);

	public function queryBySenha($value);

	public function queryByTipo($value);


	public function deleteByNome($value);

	public function deleteByUsername($value);

	public function deleteBySenha($value);

	public function deleteByTipo($value);


}
?>