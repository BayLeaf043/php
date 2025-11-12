<?php
// Модель "гаманець"
class Wallet {
    public $mainBalance;   // основний рахунок
    public $creditBalance; // доступний кредит

    public function __construct($mainBalance, $creditBalance) {
        $this->mainBalance   = (float)$mainBalance;
        $this->creditBalance = (float)$creditBalance;
    }
}

// Базовий обробник ланцюга 
abstract class PaymentHandler {
    protected $_next = null;

    public function setNext($next) {
        $this->_next = $next;
        return $next;
    }

    // Публічний "вхід" у ланцюг
    public function handle($amount, Wallet $wallet) {
        // Якщо поточний обробник не впорався — передаємо далі
        if (!$this->process($amount, $wallet)) {
            if ($this->_next) {
                $this->_next->handle($amount, $wallet);
            } else {
                // Нікого більше в ланцюгу — відмовляємо
                echo "❌ Оплату на суму {$amount} відхилено: недостатньо коштів.\n";
            }
        }
    }

    // Кожен конкретний обробник реалізує свою перевірку/списання
    abstract protected function process($amount, Wallet $wallet);
}

// Обробник: Основний рахунок 
class MainAccountHandler extends PaymentHandler {
    protected function process($amount, Wallet $wallet) {
        if ($wallet->mainBalance >= $amount) {
            $wallet->mainBalance -= $amount;
            echo "✅ Оплачено {$amount} з ОСНОВНОГО рахунку. Залишок: {$wallet->mainBalance}\n";
            return true;
        }
        // грошей не вистачає — не обробляємо, передаємо далі
        return false;
    }
}

// Обробник: Кредитна картка 
class CreditCardHandler extends PaymentHandler {
    protected function process($amount, Wallet $wallet) {
        if ($wallet->creditBalance >= $amount) {
            $wallet->creditBalance -= $amount;
            echo "✅ Оплачено {$amount} з КРЕДИТНОЇ картки. Доступний кредит: {$wallet->creditBalance}\n";
            return true;
        }
        // кредиту не вистачає — передаємо далі (відмова)
        return false;
    }
}

// Приклад використання 

// гаманець: 100 на основному, 150 доступного кредиту
$wallet = new Wallet(100, 150);

// ланцюг: Main → Credit
$main   = new MainAccountHandler();
$credit = new CreditCardHandler();
$main->setNext($credit);

// Тести:
$main->handle(70,  $wallet); // вистачить з основного
echo "<br>";
$main->handle(60,  $wallet); // після попередньої операції на основному може не вистачити — піде на кредит
echo "<br>";
$main->handle(200, $wallet); // може не вистачити ні там, ні там — відмова
