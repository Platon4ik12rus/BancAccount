<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\BankAccount;
use App\InvalidAmountException;
use App\InsufficientFundsException;

$account = null;

try {
    $account = new BankAccount(1000.00);
    echo "Счет открыт. Начальный баланс: " . $account->getBalance() . " руб.";

    $account->deposit(500.0);
    echo "После пополнения +500: " . $account->getBalance() . " руб.";

    $account->withdraw(200.0);
    echo "После снятия -200: " . $account->getBalance() . " руб.";

    $account->withdraw(5000.0); // Это вызовет исключение
    echo "Это сообщение не появится.";

} catch (InvalidAmountException $e) {
    echo "Ошибка операции: " . $e->getMessage() . "";
} catch (InsufficientFundsException $e) {
    echo "Ошибка при снятии: " . $e->getMessage() . "";
    echo "Текущий баланс: " . ($account?->getBalance() ?? 'неизвестен') . " руб.";
}

// Дополнительные тесты
try {
    $account->deposit(0.0);
} catch (InvalidAmountException $e) {
    echo "Попытка пополнения на 0: " . $e->getMessage() . "";
}

try {
    $account->withdraw(-100.0);
} catch (InvalidAmountException $e) {
    echo "Попытка снятия отрицательной суммы: " . $e->getMessage() . "";
}

echo "Итоговый баланс на счёте: " . $account->getBalance() . " руб.";