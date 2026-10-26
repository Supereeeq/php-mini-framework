<?php

class NotEnoughtMoney extends \Exception
{
}

class Wallet{
    public function __construct(
        private int $balance
    ){

    }
    public function deposit(int $amount): void
    {
        if($amount <= 0) throw new \InvalidArgumentException("Kwota nie moze byc ujemna");
        else $this->balance += $amount;
    }
    public function withdraw(int $amount):void
    {
        if($amount <= 0) throw new \InvalidArgumentException("Kwota nie moze byc ujemna");
        else $this->balance -= $amount;
    }
    public function balance():int
    {
        if($this->ballance <= 0) throw new NotEnoughtMoney("Nie ma wystarczajaco pieniedzy");
        else return $this->balance;
    }
    public static function create(int $balance):self
    {
        return new self($balance);
    }
}

// $portfel = new Wallet(100);
// echo $portfel->balance();

try
{
    $portfel = new Wallet(100);
    // $portfel->deposit(-10);

    $portfel2 = new Wallet(10);
    $portfel2->withdraw(20);
    $portfel2->balance();

    $portfel3->create(10);
    $portfel3->balance = 1000;
}
catch(\InvalidArgumentException $e)
{
    echo $e->getMessage();
}
catch(NotEnoughtMoney $e)
{
    echo $e->getMessage();
}