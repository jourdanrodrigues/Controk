<?php
function __autoload($className) {
    require_once $className.'.php';
}
public class Funcionario extends Cliente{
	private $idFuncionario;
	private $cargo;
	public function cadastrarFuncionario($nome,$cpf,$cargo,$obs){
		$this->nome=$nome;
		$this->cpf=$cpf;
		$this->obs=$obs;
		$this->cargo=$cargo;
		$mysqli=conectar();
		$queryInsert='insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values ("'.$this->nome.'","'.$this->cpf.'","'.$this->obs.'","'.$this->cargo.'",'.$this->idEndereco.','.$this->idContato.');';
		if(!mysqli_query($mysqli,$queryInsert)){
			die ('<script>alert("Não foi possível cadastrar o funcionário:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			$this->idFuncionario=mysqli_insert_id($mysqli);
			echo '<script>alert("Cadastro do funcionario '.$this->nome.', de ID '.$this->idFuncionario.', finalizado com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function buscarDadosFuncionario($id){
		if($this->idFuncionario!=$id){
			$this->nome=getValueInBank('nome','funcionario','id',$id);
			$this->cpf=getValueInBank('cpf','funcionario','id',$id);
			$this->cargo=getValueInBank('cargo','funcionario','id',$id);
			$this->obs=getValueInBank('obs','funcionario','id',$id);
			$this->idFuncionario=$id;
		}
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idFuncionario" value="'.$this->idFuncionario.'">';
		echo '<input type="hidden" name="nomeFunc" value="'.$this->nome.'">';
		echo '<input type="hidden" name="cpf" value="'.$this->cpf.'">';
		echo '<input type="hidden" name="cargo" value="'.$this->cargo.'">';
		echo '<input type="hidden" name="obs" value="'.$this->obs.'">';
		$this->buscaDadosEndereco($this->idEndereco);
		$this->buscaDadosContato($this->idContato);
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarFuncionario($id,$nome,$cpf,$cargo,$obs){
		$this->idFuncionario=$id;
		$this->nome=$nome;
		$this->cpf=$cpf;
		$this->obs=$obs;
		$this->cargo=$cargo;
		$mysqli=conectar();
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
	public function excluirFuncionario($id){
		$nome=getValueInBank('nome','funcionario','id',$id);
		$delFuncionario='delete from funcionario where id='.$id.';';
		$mysqli=conectar();
		if(!mysqli_query($mysqli,$delFuncionario)){
			die ('<script>alert("Não foi possível excluir o funcionário:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do funcionário '.$nome.', de ID '.$id.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>