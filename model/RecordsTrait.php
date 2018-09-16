<?php

trait RecordsTrait
{
    use DatabaseTrait;

    public function isExistRecord($id, $table)
    {
        $fields = 'id AS id ';
        $record = $this->getRecord($id, $table, $fields);
        if (!empty($record)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteRecord($id, $table)
    {
        if ($this->isExistRecord($id, $table)) {
            $request = 'DELETE FROM ';
            $request .=  $table;
            $request .=' WHERE id = :id';
            $requestParams = [':id' => $id];
            $this->doRequest($request, $requestParams);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAllRecords($table, $fields, $sortField = 'id', $sortOrder = "ASC")
    {
        $record = [];
        if (empty($fields)) {
            $fields = '*';
        }
        $request = 'SELECT ';
        $request .= $fields;
        $request .= ' FROM ';
        $request .=  $table;
        $request .=' ORDER BY ';
        $request .= $sortField;
        $request .= ' '.$sortOrder;
        $requestParams = [':id' => $id];
        $record = $this->doRequest($request, $requestParams);
        if (!empty($record)) {
            return $record;
        } else {
            return FALSE;
        }
    }

    public function getRecordByFieldValue($table, $fields, $targetField = 'id', $value = '')
    {
        $record = [];
        if (empty($fields)) {
            $fields = '*';
        }
        $request = 'SELECT ';
        $request .= $fields;
        $request .= ' FROM ';
        $request .=  $table;
        $request .=' WHERE ';
        $request .= $targetField .'=:'.$value;
        $requestParams = [':'.$value => $value];
        $record = $this->doRequest($request, $requestParams);
        if (!empty($record)) {
            return $record;
        } else {
            return FALSE;
        }
    }

    public function getRecord($id, $table, $fields)
    {
        $record = $this->getRecordByFieldValue($table, $fields, 'id', $id);
        return $record;
    }

}
