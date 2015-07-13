<?php
class Funcionario extends Cliente{
	public $idFuncionario;
	public $cargo;
	public function cadastrarFuncionario(){
		$mysqli=$this->conectar();
		$queryInsert='insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values ("'.$this->nome.'","'.$this->cpf.'","'.$this->obs.'","'.$this->cargo.'",'.$this->idEndereco.','.$this->idContato.');';
		if(!mysqli_query($mysqli,$queryInsert)){
			die ('<script>alert("Não foi possível cadastrar o funcionário:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idFuncionario=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do funcionario '.$this->nome.', de ID '.$this->idFuncionario.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosFuncionario(){
		$this->nome=$this->getValueInBank('nome','funcionario','id',$this->idFuncionario);
		$this->cpf=$this->getValueInBank('cpf','funcionario','id',$this->idFuncionario);
		$this->cargo=$this->getValueInBank('cargo','funcionario','id',$this->idFuncionario);
		$this->obs=$this->getValueInBank('obs','funcionario','id',$this->idFuncionario);
		$this->idEndereco=$this->getValueInBank('endereco','funcionario','id',$this->idFuncionario);
		$this->idContato=$this->getValueInBank('contato','funcionario','id',$this->idFuncionario);
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idFuncionario" value="'.$this->idFuncionario.'">';
		echo '<input type="hidden" name="nomeFunc" value="'.$this->nome.'">';
		echo '<input type="hidden" name="cpf" value="'.$this->cpf.'">';
		echo '<input type="hidden" name="cargo" value="'.$this->cargo.'">';
		echo '<input type="hidden" name="obs" value="'.$this->obs.'">';
		$this->buscarDadosEndereco();
		$this->buscarDadosContato();
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarFuncionario(){
		$this->idEndereco=$this->getValueInBank('endereco','funcionario','id',$this->idFuncionario);
		$this->idContato=$this->getValueInBank('contato','funcionario','id',$this->idFuncionario);
		$mysqli=$this->conectar();
		$updFuncionario='update funcionario set nome="'.$this->nome.'",cpf="'.$this->cpf.'",obs="'.$this->obs.'",cargo="'.$this->cargo.'" where id='.$this->idFuncionario.';';
		if(!mysqli_query($mysqli,$updFuncionario)){
			die ('
			<script>
				alert("Não foi possível atualizar o funcionário:\n\n'.mysqli_error($mysqli).'");
				location.href="/trabalhos/gti/bda1/";
			</script>');
		}else{
			echo '<script>alert("Atualização do funcionário '.$this->nome.', de ID '.$this->idFuncionario.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirFuncionario(){
		$this->nome=$this->getValueInBank('nome','funcionario','id',$this->idFuncionario);
		$this->idContato=$this->getValueInBank('contato','funcionario','id',$this->idFuncionario);
		$this->idEndereco=$this->getValueInBank('endereco','funcionario','id',$this->idFuncionario);
		$this->excluirContato();
		$this->excluirEndereco();
		$delFuncionario='delete from funcionario where id='.$this->idFuncionario.';';
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$delFuncionario)){
			die ('<script>alert("Não foi possível excluir o funcionário:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do funcionário '.$this->nome.', de ID '.$this->idFuncionario.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>