<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return AgendamentoDAO
	 */
	public static function getAgendamentoDAO(){
		return new AgendamentoMySqlExtDAO();
	}

	/**
	 * @return AgendamentoServicoDAO
	 */
	public static function getAgendamentoServicoDAO(){
		return new AgendamentoServicoMySqlExtDAO();
	}

	/**
	 * @return ClienteDAO
	 */
	public static function getClienteDAO(){
		return new ClienteMySqlExtDAO();
	}

	/**
	 * @return CompraDAO
	 */
	public static function getCompraDAO(){
		return new CompraMySqlExtDAO();
	}

	/**
	 * @return ConfiguracaoDAO
	 */
	public static function getConfiguracaoDAO(){
		return new ConfiguracaoMySqlExtDAO();
	}

	/**
	 * @return DespesaDAO
	 */
	public static function getDespesaDAO(){
		return new DespesaMySqlExtDAO();
	}

	/**
	 * @return FornecedorDAO
	 */
	public static function getFornecedorDAO(){
		return new FornecedorMySqlExtDAO();
	}

	/**
	 * @return FuncionarioDAO
	 */
	public static function getFuncionarioDAO(){
		return new FuncionarioMySqlExtDAO();
	}

	/**
	 * @return ProdutoDAO
	 */
	public static function getProdutoDAO(){
		return new ProdutoMySqlExtDAO();
	}

	/**
	 * @return ProdutoVendaDAO
	 */
	public static function getProdutoVendaDAO(){
		return new ProdutoVendaMySqlExtDAO();
	}

	/**
	 * @return ServicoDAO
	 */
	public static function getServicoDAO(){
		return new ServicoMySqlExtDAO();
	}

	/**
	 * @return ServicoVendaDAO
	 */
	public static function getServicoVendaDAO(){
		return new ServicoVendaMySqlExtDAO();
	}

	/**
	 * @return UtensilioDAO
	 */
	public static function getUtensilioDAO(){
		return new UtensilioMySqlExtDAO();
	}

	/**
	 * @return VendaDAO
	 */
	public static function getVendaDAO(){
		return new VendaMySqlExtDAO();
	}


}
?>