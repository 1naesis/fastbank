<?php


namespace App\Model;


interface ClientInterface
{
    /**
     * @param array $post
     */
    public function fillData(array $post): void;

    /**
     * @return bool
     */
    public function validate(): bool;

    /**
     * @return array
     */
    public function getError(): array;
}