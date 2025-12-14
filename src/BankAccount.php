<?php

declare(strict_types=1);

namespace App;

class BankAccount
{
    private float $balance;

    public function __construct(float $initialBalance = 0.0)
    {
        if ($initialBalance < 0) {
            throw new InvalidAmountException("Начальный баланс не может быть отрицательным.");
        }

        $this->balance = $initialBalance;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }


    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException("Сумма пополнения должна быть положительной.");
        }

        $this->balance += $amount;
    }


    public function withdraw(float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException("Сумма снятия должна быть положительной.");
        }

        if ($amount > $this->balance) {
            throw new InsufficientFundsException("Недостаточно средств на счете.");
        }

        $this->balance -= $amount;
    }
}