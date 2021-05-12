<?php

namespace App\Model;

class HikingManager extends AbstractManager
{
    public const TABLE = 'mark';


    public function selectAllFilter(int $valeur): array
    {
        $query = 'SELECT * FROM mark WHERE filter = ' . $valeur . ';';
        $list = $this->pdo->query($query)->fetchAll();
        return $list;
    }
}
