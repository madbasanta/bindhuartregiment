<?php

class DBMigration
{
    protected $tableName;
    protected $columns = [];
    protected $foreignKeys = [];
    protected $alterColumns = [];
    protected $newColumns = [];

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function increments($columnName)
    {
        $this->columns[] = [
            'type' => 'BIGINT UNSIGNED',
            'name' => $columnName,
            'options' => ['AUTO_INCREMENT', 'PRIMARY KEY'],
        ];
        return $this;
    }

    public function bigint($columnName, $unsigned = false)
    {
        $type = $unsigned ? 'BIGINT UNSIGNED' : 'BIGINT';

        $this->columns[] = [
            'type' => $type,
            'name' => $columnName,
        ];
        return $this;
    }

    public function integer($columnName, $unsigned = false)
    {
        $type = $unsigned ? 'INT UNSIGNED' : 'INT';

        $this->columns[] = [
            'type' => $type,
            'name' => $columnName,
        ];
        return $this;
    }

    public function string($columnName, $length = 255)
    {
        $this->columns[] = [
            'type' => 'VARCHAR(' . $length . ')',
            'name' => $columnName,
        ];
        return $this;
    }

    public function text($columnName, $prefixOption = '')
    {
        $this->columns[] = [
            'type' => $prefixOption .'TEXT',
            'name' => $columnName,
        ];
        return $this;
    }

    public function time($columnName)
    {
        $this->columns[] = [
            'type' => 'TIME',
            'name' => $columnName,
        ];
        return $this;
    }

    public function timestamp($columnName)
    {
        $this->columns[] = [
            'type' => 'TIMESTAMP',
            'name' => $columnName,
        ];
        return $this;
    }

    public function boolean($columnName, $default = null)
    {
        $this->columns[] = [
            'type' => 'TINYINT',
            'name' => $columnName,
            'options' => ['DEFAULT', $default],
        ];
        return $this;
    }

    public function nullable($null = true)
    {
        $lastColumn = array_pop($this->columns);
        $lastColumn['options'][] = $null ? 'NULL' : 'NOT NULL';
        $this->columns[] = $lastColumn;
        return $this;
    }

    public function foreign($columnName, $referencesTable, $referencesColumn = 'id')
    {
        $this->foreignKeys[] = [
            'column' => $columnName,
            'referencesTable' => $referencesTable,
            'referencesColumn' => $referencesColumn,
        ];
        return $this;
    }

    public function alterColumn($columnName, $newColumnType, $options = [])
    {
        $this->alterColumns[] = [
            'column' => $columnName,
            'newType' => $newColumnType,
            'options' => $options,
        ];
    }

    public function addColumnIfNotExists($columnName, $columnType, $options = [])
    {
        $this->newColumns[] = [
            'name' => $columnName,
            'type' => $columnType,
            'options' => $options,
        ];
        return $this;
    }

    public function generateSQL()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `$this->tableName` (";

        foreach ($this->columns as $column) {
            $sql .= "`{$column['name']}` {$column['type']}";

            if (!empty($column['options'])) {
                $sql .= ' ' . implode(' ', $column['options']);
            }

            $sql .= ', ';
        }

        foreach ($this->foreignKeys as $foreignKey) {
            $sql .= "FOREIGN KEY (`{$foreignKey['column']}`)
                        REFERENCES `{$foreignKey['referencesTable']}`(`{$foreignKey['referencesColumn']}`), ";
        }

        $sql = rtrim($sql, ', ');
        $sql .= ');';

        return $sql;
    }

    public function generateAlterTableSQL()
    {
        $sql = '';

        foreach ($this->alterColumns as $alterColumn) {
            $sql .= "ALTER TABLE `$this->tableName` CHANGE COLUMN `{$alterColumn['column']}` `{$alterColumn['column']}` {$alterColumn['newType']}";

            if (!empty($alterColumn['options'])) {
                $sql .= ' ' . implode(' ', $alterColumn['options']);
            }

            $sql .= ';';
        }

        return $sql;
    }

    public function generateAddColumnSQL()
    {
        $sql = '';

        $existingColumns = ORM::table('information_schema.columns')
            ->where('table_name', $this->tableName)
            ->where('table_schema', config('database.database'))
            ->get();
        $existingColumns = array_column($existingColumns, 'COLUMN_NAME');

        foreach ($this->newColumns as $newColumn) {
            if(in_array($newColumn['name'], $existingColumns)) {
                continue;
            }
            $sql .= "ALTER TABLE `$this->tableName` ADD COLUMN `{$newColumn['name']}` {$newColumn['type']}";

            if (!empty($newColumn['options'])) {
                $sql .= ' ' . implode(' ', $newColumn['options']);
            }

            $sql .= ';';
        }

        return $sql;
    }
}