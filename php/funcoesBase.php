<?php
function procurarArquivos($pasta,$arquivo,$ds='/'){
	if (is_dir($pasta)){
		if (file_exists($pasta.$ds.$arquivo)){
			return $pasta.$ds.$arquivo;
		}
		$dirs=array_diff(scandir($pasta, 1), array('.','..'));
		foreach ($dirs as $dir) {
			if (!is_dir($pasta.$ds.$dir)){
				continue;
			}else{
				$f=procurarArquivos($pasta.$ds.$dir, $arquivo, $ds);
				if ($f!==false){
					return $f;
				}
			}
		}
	}else{
		return false;
	}
}
?>