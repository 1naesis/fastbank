<?php


namespace App\Model;


class Client implements ClientInterface
{
    const INDIVIDUAL = 1;
    const LEGAL_ENTITY = 2;

    public string $surname;
    public string $name;
    public string $patronymic;
    public int $inn;
    public ?\DateTimeInterface $date_birth;
    public int $passport_serial;
    public int $passport_number;
    public ?\DateTimeInterface $passport_date;
    public string $company_name;
    public string $company_address;
    public int $company_ogrn;
    public int $company_inn;
    public int $company_kpp;
    public int $client_type;

    private array $error = [];

    public function __construct($client_type = 1)
    {
        $this->client_type = (int)$client_type;
    }

    public function fillData(array $post): void
    {
        $this->surname = trim($post['surname']);
        $this->name = trim($post['name']);
        $this->patronymic = trim($post['patronymic']);
        $this->inn = abs((int)$post['inn']);
        if ($this->client_type == self::INDIVIDUAL) {
            $this->date_birth = !empty($post['date_birth'])? new \DateTimeImmutable(trim($post['date_birth'])): null;
            $this->passport_serial = abs((int)trim($post['passport_serial']));
            $this->passport_number = abs((int)trim($post['passport_number']));
            $this->passport_date = !empty($post['passport_date'])? new \DateTimeImmutable(trim($post['passport_date'])): null;
        } else if ($this->client_type == self::LEGAL_ENTITY) {
            $this->company_name = trim($post['company_name']);
            $this->company_address = trim($post['company_address']);
            $this->company_ogrn = abs((int)$post['company_ogrn']);
            $this->company_inn = abs((int)$post['company_inn']);
            $this->company_kpp = abs((int)$post['company_kpp']);
        }
    }

    public function validate(): bool
    {
        if (isset($this->surname) && !empty($this->surname)) {
            if (mb_strlen($this->surname) < 2) {
                $this->error['surname'] = 'Имя должно содержать более 2 букв';
            }
        } else {
            $this->error['surname'] = 'Не заполнено Имя';
        }

        if (isset($this->name) && !empty($this->name)) {
            if (mb_strlen($this->name) < 2) {
                $this->error['name'] = 'Фамилия должна содержать более 2 букв';
            }
        } else {
            $this->error['name'] = 'Не заполнена Фамилия';
        }

        if (isset($this->patronymic) && !empty($this->patronymic)) {
            if (mb_strlen($this->patronymic) < 2) {
                $this->error['patronymic'] = 'Отчество должно содержать более 2 букв';
            }
        } else {
            $this->error['patronymic'] = 'Не заполнено Отчество';
        }

        if (isset($this->inn) && !empty($this->inn)) {
            if (mb_strlen($this->inn) != 12) {
                $this->error['inn'] = 'ИНН должен быть 12 цифр';
            }
        } else {
            $this->error['inn'] = 'Не заполнено поле ИНН';
        }
        if ($this->client_type == self::INDIVIDUAL) {
            if (!isset($this->date_birth) || empty($this->date_birth)) {
                $this->error['date_birth'] = 'Не выбрана дата рождения';
            }
            if (isset($this->passport_serial) && !empty($this->passport_serial)) {
                if (mb_strlen($this->passport_serial) != 4) {
                    $this->error['passport_serial'] = 'Серия паспорта должен быть 4 цифры';
                }
            } else {
                $this->error['passport_serial'] = 'Не заполнена серия паспорта';
            }
            if (isset($this->passport_number) && !empty($this->passport_number)) {
                if (mb_strlen($this->passport_number) != 6) {
                    $this->error['passport_number'] = 'Номер паспорта должен быть 6 цифры';
                }
            } else {
                $this->error['passport_number'] = 'Не заполнен номер паспорта';
            }
            if (!isset($this->passport_date) || empty($this->passport_date)) {
                $this->error['passport_date'] = 'Не выбрана дата выдачи паспорта';
            }
        } else if ($this->client_type == self::LEGAL_ENTITY) {
            if (isset($this->company_name) && !empty($this->company_name)) {
                if (mb_strlen($this->company_name) < 2) {
                    $this->error['company_name'] = 'Название компании должно содержать более 2 букв';
                }
            } else {
                $this->error['company_name'] = 'Не заполнено Название компании';
            }
            if (!isset($this->company_address) || empty($this->company_address)) {
                $this->error['company_address'] = 'Не заполнен адрес';
            }

            if (!isset($this->company_ogrn) || empty($this->company_ogrn)) {
                $this->error['company_ogrn'] = 'Не заполнен номер ОГРН';
            }
            if (isset($this->company_inn) && !empty($this->company_inn)) {
                if (mb_strlen($this->company_inn) != 12) {
                    $this->error['company_inn'] = 'ИНН должен быть 12 цифры';
                }
            } else {
                $this->error['company_inn'] = 'Не заполнен номер ИНН';
            }
            if (isset($this->company_kpp) && !empty($this->company_kpp)) {
                if (mb_strlen($this->company_kpp) != 9) {
                    $this->error['company_kpp'] = 'Номер КПП должен быть 9 цифры';
                }
            } else {
                $this->error['company_kpp'] = 'Не заполнен номер КПП';
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