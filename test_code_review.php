<?php

/**
 * В одном файле не следует объявлять несколько классов(интерфейсов, трейтов)
 * файл назвать как класс
 * Классам, интерфейсам, трейтам необходимо давать имена в стиле PascalCase
 * нарушен принцип единственной ответственности, сегрегация интерфейсов
 */
interface iCart
{
    /**
     * переименовать в getTotalVat()
     */
    public function calcVat();

    /**
     * метод следует перенести в UseCase по созданию заказа
     * сделать метод приватным
     */
    public function notify();

    /**
     * 1.0 представляется как 100% скидка, неоднозначное понимание
     * метод следует перенести в UseCase по созданию заказа
     */
    public function makeOrder($discount = 1.0);
}

/**
 * Не подлежит модульному тестированию:
 *      в методе прописано подключение к почтовому сервису,
 *      непонятно к какому пользователю принадлежит корзина (наверно береться из сессии)
 */
class Cart implements iCart
{
    /**
     * следует переименовать в более подходящие $products или $goods
     * сделать свойтво приватным, добавить геттер и сеттер
     */
    public $items;
    /**
     * сделать свойтво приватным, добавить геттер и сеттер
     */
    public $order;

    public function calcVat()
    {
        $vat = 0;
        foreach ($this->items as $item) {
            // Получение НДС товара нужно перенести в метод товара $item->getVatCost()
            // Только товар может знать сколько у него НДС, в зависимости от категории товара
            $vat += $item->getPrice() * 0.18;
        }

        return $vat;
    }

    public function notify()
    {
        $this->sendMail();
    }

    /**
     * Отправку писем следует вынести в отдельный сервис
     * метод должен быть приватным
     */
    public function sendMail()
    {
        // переименовать в $mailer
        // не следует здесь инстанцировать почтовый сервис, логин и пароль следует вынести в конфиг или в env
        // В конструкторе можно инъектировать почтовый сервис
        $m = new SimpleMailer('cartuser', 'j049lj-01');
        // переименовать в $totalPrice
        $p = 0;
        // не следует дублировать логику подсчета суммы заказа, уже есть расхождение сумм
        foreach ($this->items as $item) {
            // Получение стоимости товара с НДС нужно перенести в метод товара $item->getPrice($withVat = true)
            // Только товар может знать сколько у него НДС, в зависимости от категории товара
            $p += $item->getPrice() * 1.18;
        }
        // возможна ошибка $this->order может быть null
        // метод следует назвать $this->order->getId()
        // переименовать в $message
        // перенести в слой шаблонов
        // стоимость будет отличаться от стоимости в заказе
        $ms = "<p> <b>".$this->order->id()."</b> ".$p." .</p>";
        // непонятная логика отправки заказа всем менеджерам сразу, как они распределят его между собой
        $m->sendToManagers($ms);
    }

    /**
     * Ошибка реализации интерфейса makeOrder($discount = 1.0)
     */
    public function makeOrder($discount)
    {
        // переименовать в $totalPrice
        $p = 0;
        // не следует дублировать логику подсчета суммы заказа
        foreach ($this->items as $item) {
            // Получение стоимости товара с НДС нужно перенести в метод товара $item->getPrice($withVat = true)
            // Только товар может знать сколько у него НДС, в зависимости от категории товара
            $p += $item->getPrice() * 1.18 * $discount;
        }
        // Ордер сам может посчитать стоимость товаров
        // можно корзину конвертировать в ордер
        $this->order = new Order($this->items, $p);
        // Поменять на метод интерфейса $this->notify()
        $this->sendMail();
    }
}