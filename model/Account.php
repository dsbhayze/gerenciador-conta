<?php
 
class Account {
  
    public $id;
    public $saldo;
    
    public function sacar(int $valor){
        echo "<br/>Saque realizado com sucesso!";
        if($this.saldo > $this.valor){
        $this->saldo -= $this->valor;
        return $this->saldo;
    }

    public function deposito(int $valor){
        echo "<br/>Depósito realizado com sucesso!";
        $this->saldo += $this->valor;
        return $this->saldo;
    }
}
?>