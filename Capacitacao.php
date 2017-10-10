<?php

	// Classe resposnsável por criar objetos de Capacitação

	class Capacitacao
	{
		// Atributos da Capacitação, serão definidos no construct

		private $_id,
				$_nomeDoCurso,
				$_nomeDeApresentacao,
				$_descricaoBasica,
				$_ementa,
				$_ministrante,
				$_cargaHoraria,
				$_periodo,
				$_horario,
				$_local,
				$_icone;

		// Constructor deve receber um array com dos dados do evento, na ordem padronizada

		public function __construct ($p_dadosDoEvento)
		{
			$this->_id = $p_dadosDoEvento[0];
			$this->_nomeDoCurso = $p_dadosDoEvento[1];
			$this->_nomeDeApresentacao = $p_dadosDoEvento[2];
			$this->_descricaoBasica = $p_dadosDoEvento[3];
			$this->_ementa = $p_dadosDoEvento[4];
			$this->_ministrante = $p_dadosDoEvento[5];
			$this->_cargaHoraria = $p_dadosDoEvento[6];
			$this->_periodo = $p_dadosDoEvento[7];
			$this->_horario = $p_dadosDoEvento[8];
			$this->_local = $p_dadosDoEvento[9];
			$this->_icone = $p_dadosDoEvento[10];
		}

		// Atributos do objeto são acessados pelo seu nome padrão deles

		public function __get($name)
		{
			return $this->$name;
		}

		// Método responsável retornar um Array com os dados do Objeto

		public function paraArray () {
			return array (
				$this->_id,
				$this->_nomeDoCurso,
				$this->_nomeDeApresentacao,
				$this->_descricaoBasica,
				$this->_ementa,
				$this->_ministrante,
				$this->_cargaHoraria,
				$this->_periodo,
				$this->_horario,
				$this->_local,
				$this->_icone	
			);
		}
	}