<?php

class Answer extends Model
{
    private $recordset = NULL;
    private $tableName = 'answers';

    public function add($data)
    {
        $request = 'INSERT INTO answers (
                        questionId,
                        description)
                    VALUES (
                        :questionId,
                        :description)';
        $requestParams = [
            ':questionId' => $data['questionId'],
            ':description' => $data['description']
        ];
        $this->doRequest($request, $requestParams);
        return TRUE;
    }

    public function delete($id)
    {
        return $this->deleteRecord($id, $this->tableName);
    }

    public function update($id, $data)
    {
        if ($this->isExistRecord($id, $this->tableName)) {
            $request = 'UPDATE
                            answers
                        SET
                            questionId=:questionId,
                            description=:description
                        WHERE
                            id=:id';
            $params = [
                ':questionId' => $data['questionId'],
                ':description' => $data['description'],
                ':id' => $id
            ];
            $this->doRequest($request, $params);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getList()
    {
        $fields = ' id AS id,
                    questionId,
                    description,
                    date_added';
        $this->recordset = $this->getAllRecords($this->tableName, $fields, 'questionId', 'ASC');
        if (!empty($this->recordset)) {
            return $this->recordset;
        } else {
            return FALSE;
        }
    }

    public function getById($id)
    {
        $fields = ' id AS id,
                    questionId,
                    description,
                    date_added';
        $this->recordset = $this->getRecord($id, $this->tableName, $fields);
        if (empty($this->recordset)) {
            return NULL;
        } else {
            return $this->recordset[0];
        }
    }

    public function getByQuestion($questionId)
    {
        $request = 'SELECT
                        answers.id AS id,
                        answers.description AS description,
                        answers.date_added AS date_added
                    FROM
                        answers
                    WHERE
                        answers.questionId = :questionId
                    ORDER BY date_added DESC';
        $params = [
            ':questionId' => $questionId
        ];
        $this->recordset = $this->doRequest($request, $params);
        if (!isset($this->recordset)) {
            return NULL;
        }
        return $this->recordset;
    }

}
