<?php 

class InvalidAmountException extends Exception{}
class InsufficientFundsException extends Exception{}

class BankAccount 
{
    private float $balance;

    public function __construct(float $initialBalance)
    {
        if($initialBalance < 0){
            throw new InvalidAmountException("Начальный баланс не может быть отриательным");
        }
            $this->balance = $initialBalance;
    }
    public function getBalance(): float
    {
        return $this->balance;
    }
    public function withdraw(float $amount): void
    {
        if($amount <=0){
            throw new InsufficientFundsException("Недостаточно средств для снятия указанной суммы.");
           
        }
         $this->balance -= $amount;
    }

}


$account = null;
try {
    $account = new BankAccount(1000.00);
    echo "Счет открыт. Начальный баланс:". $account->getBalance();
}catch(InvalidAmountException $e){
    echo "Ошибка при создании счёта: " . $e->getMessage();
    exit(1);
}
 try {
     $account->deposit(500.0);
     echo "После пополнения +500: " . $account->getBalance();
}catch (InvalidAmountException $e) {
    echo "Ошибка пополнения: " . $e->getMessage();
}

 try {
   $account->withdraw(200.0);
     echo "После снятия -200: " . $account->getBalance();
 } catch (InvalidAmountException $e) {
    echo "Ошибка при снятии: " . $e->getMessage() ;
 } catch (InsufficientFundsException $e) {
     echo "Ошибка при снятии: " . $e->getMessage();
 }


 try {
$account->withdraw(5000.0);
     echo "После снятия -5000: " . $account->getBalance();
}catch (InvalidAmountException $e) {
     echo "Ошибка при снятии: " . $e->getMessage();
}catch (InsufficientFundsException $e) {
    echo "Ошибка при снятии (недостаточно средств): " . $e->getMessage();
}
try {
     $account->deposit(0.0);
     echo "После пополнения +0: " . $account->getBalance();
}catch (InvalidAmountException $e) {
    echo "Ошибка пополнения (некорректная сумма): " . $e->getMessage();
}
echo "Итоговый баланс на счёте: " . $account->getBalance();

?>

