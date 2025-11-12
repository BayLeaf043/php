<?php

// Абстрактний клас — базовий для всіх обробників
abstract class AbstractHandler
{
    /**
     * @var AbstractHandler|null
     */
    protected $_next = null;

    /**
     * Абстрактний метод, який мають реалізувати конкретні обробники
     *
     * @param mixed $message
     */
    abstract public function sendRequest($message);

    /**
     * Встановлює наступного обробника в ланцюгу
     *
     * @param AbstractHandler $next
     */
    public function setNext($next)
    {
        $this->_next = $next;
    }

    /**
     * Повертає наступного обробника в ланцюгу
     *
     * @return AbstractHandler|null
     */
    public function getNext()
    {
        return $this->_next;
    }
}

// Конкретний обробник A
class ConcreteHandlerA extends AbstractHandler
{
    public function sendRequest($message)
    {
        if ($message == 1) {
            echo __CLASS__ . " processed this message<br>";
        } else {
            if ($this->getNext()) {
                $this->getNext()->sendRequest($message);
            } else {
                echo "No handler could process this message<br>";
            }
        }
    }
}

// Конкретний обробник B
class ConcreteHandlerB extends AbstractHandler
{
    public function sendRequest($message)
    {
        if ($message == 2) {
            echo __CLASS__ . " processed this message<br>";
        } else {
            if ($this->getNext()) {
                $this->getNext()->sendRequest($message);
            } else {
                echo "No handler could process this message<br>";
            }
        }
    }
}

// --- Використання патерну ---

$handlerA = new ConcreteHandlerA();
$handlerB = new ConcreteHandlerB();

// Створюємо ланцюг A → B
$handlerA->setNext($handlerB);

// Тестові виклики
$handlerA->sendRequest(1); // ConcreteHandlerA processed this message
$handlerA->sendRequest(2); // ConcreteHandlerB processed this message
$handlerA->sendRequest(3); // No handler could process this message

?>