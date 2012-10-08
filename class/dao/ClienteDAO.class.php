<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-04 13:50
 */
interface ClienteDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Cliente 
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
 	 * @param cliente primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Cliente cliente
 	 */
	public function insert($cliente);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Cliente cliente
 	 */
	public function update($cliente);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNome($value);

	public function queryByEndereco($value);

	public function queryByCpf($value);

	public function queryByRg($value);

	public function queryByNasc($value);

	public function queryByTelefone($value);

	public function queryByCelular($value);

	public function queryByEnderecoTrabalho($value);

	public function queryByTelefoneTrabalho($value);

	public function queryByCabelo($value);

	public function queryByUsername($value);

	public function queryBySenha($value);

	public function queryByAdmin($value);


	public function deleteByNome($value);

	public function deleteByEndereco($value);

	public function deleteByCpf($value);

	public function deleteByRg($value);

	public function deleteByNasc($value);

	public function deleteByTelefone($value);

	public function deleteByCelular($value);

	public function deleteByEnderecoTrabalho($value);

	public function deleteByTelefoneTrabalho($value);

	public function deleteByCabelo($value);

	public function deleteByUsername($value);

	public function deleteBySenha($value);

	public function deleteByAdmin($value);


}
?>