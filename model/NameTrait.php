<?

trait NameTrait
{
    use DatabaseTrait;

    public function getRecordByName($name, $table, $fields)
    {
        $record = $this->getRecordByFieldValue($table, $fields, 'name', $name);
        return $record;
    }

}
