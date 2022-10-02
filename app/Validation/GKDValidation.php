<?php

namespace App\Validation;

use Config\Database;

class GKDValidation {
    public function es_clave_unica(?string $str, string $field, array $data): bool {
        [$field, $ignoreField, $ignoreValue] = array_pad(explode(',', $field), 3, null);

        sscanf($field, '%[^.].%[^.]', $table, $field);

        $row = Database::connect($data['DBGroup'] ?? null)
            ->table($table)
            ->select('1')
            ->where($field, $str)
            ->limit(1);

        if (!empty($ignoreField) && !empty($ignoreValue)) {
            $row = $row->where("$ignoreField !=", $ignoreValue);
        }

        return $row->get()->getRow() === null;
    }
}
