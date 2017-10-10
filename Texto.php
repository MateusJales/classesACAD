<?php

	// Classe responsável por gerar Objetos que se comunicam com arquivos .txt

	class Texto
	{
		// Atributos privados do objeto, a serem definidos no construct, exceto o '_handle', definido apenas no método 'connect'

		private $_path,
			    $_divisor,
			    $_handle;

		// Construct deve receber o path do arquivo .txt e a parâmetro utilizado para divisão de colunas em cada linha

		public function __construct ($p_path, $p_divisor)
		{
			$this->_path = $p_path;
			$this->_divisor = $p_divisor;
		}

		// Destruc responsável por fechar o arquivo .txt no final de cada utilização

		public function __destruct ()
		{
			fclose($this->_handle);
		}

		// Método responsável por abrir (conectar) o arquivo .txt, sendo informado o parâmetro de utilização do arquivo
		// Para ser usado internamente pela classe

		private function connect ($p_mode)
		{
			$this->_handle = fopen($this->_path, $p_mode);
		}

		// Método que retorna um array com uma tabela de dados do que está contido no arquivo .txt

		public function toArray ()
		{
			$this->connect('r');
			$id = 0;
			$array = array();
			while(!feof($this->_handle)) {
				$linhaDado = fgets($this->_handle);
				if ( ! empty($linhaDado) )
				{
					$cadaDado = explode($this->_divisor, $linhaDado);
					foreach ($cadaDado as $key => $value) 
					{
						$array[$id][$key] = trim($value);
					}
				}
				$id++;
			}
			return($array);
		}

		// Método responsável por registrar um novo dado, em formato de um array de array (tabela) onde o ID ainda não está definido no final do texto do arquivo, e sendo definido o ID do novo dado

		public function registrarDado ($p_dados)
		{
			$this->connect('a');
			for ( $i = 0; $i < count($p_dados); $i++ )
			{
				$str_dados = count($this->toArray()).$this->_divisor;
				for ($j = 0; $j < count($p_dados[$i]) - 1; $j++)
				{
					$str_dados = $str_dados.$p_dados[$i][$j].$this->_divisor;
				}
				$str_dados = $str_dados.$p_dados[$i][count($p_dados[$i]) - 1]."\n";
				fwrite($this->_handle, $str_dados);
			}
		}

		// Método responsável por rescrever os dados do arquivo .txt, através de um array de array (tabela), onde o ID já estará definido
		// Para ser usado internamente pela classe

		private function renovarDados ($p_dados)
		{
			$this->connect('w');
			for ( $i = 0; $i < count($p_dados); $i++ )
			{
				$str_dados = "";
				for ($j = 0; $j < count($p_dados[$i]) - 1; $j++)
				{
					$str_dados = $str_dados.$p_dados[$i][$j].$this->_divisor;
				}
				$str_dados = $str_dados.$p_dados[$i][count($p_dados[$i]) - 1]."\n";
				fwrite($this->_handle, $str_dados);
			}
		}

		// Método que deve ser chamado para alterar e atualizar um dado no arquivo .txt. O atributo dado deve ser um array com os dados novos da linha que será atualizada, incluindo o ID

		public function alterarLinha ($p_novosDados)
		{
			$dados = $this->toArray();
			$dados[$p_novosDados[0]] = $p_novosDados;
			$this->renovarDados($dados);
		}

		public function removerLinha ($p_localizacao, $numeroLinha)
		{

		}
	}