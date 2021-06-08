<?php


namespace App\Service;


use App\Component\Db;

class ClientService
{
    public function createClient($client):int
    {
        if ($client->client_type === $client::INDIVIDUAL) {
            $sql = "
                        INSERT INTO `client` (`surname`, `name`, `patronymic`, 
                                              `inn`, `date_birth`, `passport_serial`, 
                                              `passport_number`, `passport_date`, `client_type`)
                        VALUES (?, ?, ?, 
                              ?, ?, ?, 
                              ?, ?, ?)
                    ";
            $prepare = [
                $client->surname,
                $client->name,
                $client->patronymic,
                $client->inn,
                $client->date_birth->format('Y-m-d H:i:s'),
                $client->passport_serial,
                $client->passport_number,
                $client->passport_date->format('Y-m-d H:i:s'),
                $client->client_type
            ];
        } else if ($client->client_type === $client::LEGAL_ENTITY) {
            $sql = "
                        INSERT INTO `client` (`surname`, `name`, `patronymic`, 
                                              `inn`, `company_name`, 
                                              `company_address`, `company_ogrn`, `company_inn`, 
                                              `company_kpp`, `client_type`)
                        VALUES (?, ?, ?,
                              ?, ?,
                              ?, ?, ?,
                              ?, ?)
                    ";
            $prepare = [
                $client->surname,
                $client->name,
                $client->patronymic,
                $client->inn,
                $client->company_name,
                $client->company_address,
                $client->company_ogrn,
                $client->company_inn,
                $client->company_kpp,
                $client->client_type
            ];
        }

        if (isset($sql) && isset($prepare)) {
            Db::insert($sql, $prepare);
            return Db::query("
                SELECT `id` FROM `client` ORDER BY `id` DESC LIMIT 1;
                ")[0]['id'];
        }
        return 0;
    }
}