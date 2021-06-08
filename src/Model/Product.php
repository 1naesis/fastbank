<?php


namespace App\Model;


class Product implements ProductInterface
{
    const CREDIT = 1;
    const DEPOSIT = 2;

    public ?\DateTimeInterface $date_open;
    public ?\DateTimeInterface $date_close;
    public int $term;
    public int $amount;
    public int $rate;
    public int $capitalization;
    public int $product_type;
    private array $error = [];

    public function __construct($product_type = 1)
    {
        $this->product_type = (int)$product_type;
    }

    public function fillData(array $post): void
    {
        $this->date_open = !empty($post['date_open'])? new \DateTimeImmutable(trim($post['date_open'])): null;
        $this->date_close = !empty($post['date_open'])? new \DateTimeImmutable(trim($post['date_close'])): null;
        if ($this->product_type == self::CREDIT) {
            $this->amount = abs((int)$post['amount']);
        } else if ($this->product_type == self::DEPOSIT) {
            $this->rate = abs((int)$post['rate']);
            $this->capitalization = abs((int)$post['capitalization']);
        }
        if ($this->date_open && $this->date_close) {
            $interval = $this->date_open->diff($this->date_close);
            $this->term = $interval->m + $interval->y * 12;
        }
    }

    public function validate(): bool
    {
        if (!isset($this->date_open) || empty($this->date_open)) {
            $this->error['date_open'] = 'Не выбрана дата открытия';
        }
        if (!isset($this->date_close) || empty($this->date_close)) {
            $this->error['date_close'] = 'Не выбрана дата закрытия';
        }
        if ($this->product_type == self::CREDIT) {
            if (!isset($this->amount) || empty($this->amount)) {
                $this->error['amount'] = 'Не заполнена сумма';
            }
        } else if ($this->product_type == self::DEPOSIT) {
            if (!isset($this->rate) || empty($this->rate)) {
                $this->error['rate'] = 'Не заполнена ставка';
            }
        }
        if (count($this->error) > 0){
            return false;
        }
        return true;
    }

    public function getError(): array
    {
        return $this->error;
    }
}