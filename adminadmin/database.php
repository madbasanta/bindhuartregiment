<?php
// mysql database connection code
// object oriented

use ORM as GlobalORM;

class QueryBuilder
{
    private $connection;
    public $table;
    public $whereClause;
    public $operators = [
        '=', '<', '>', '<=', '>=', '<>', '!='
    ];

    public function __construct($connection, $table, $whereClause)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->whereClause = $whereClause;
    }

    protected function invalidOperatorAndValue($operator, $value)
    {
        return in_array($operator, ['=', '<', '>', '<=', '>=', '<>', '!=']) && is_null($value);
    }

    protected function invalidOperator($operator)
    {
        return !in_array(strtolower($operator), $this->operators, true);
    }

    public function prepareValueAndOperator($value, $operator, $useDefault = false)
    {
        if ($useDefault) {
            return [$operator, '='];
        } elseif ($this->invalidOperatorAndValue($operator, $value)) {
            throw new InvalidArgumentException('Illegal operator and value combination.');
        }

        return [$value, $operator];
    }

    protected function addNestedWhereQuery($wheres, $boolean)
    {
        $this->whereClause .= ($this->whereClause ? " $boolean " : "") . "( {$wheres} )";
        return $this;
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {

        if (is_array($column)) {
            foreach ($column as $col => $value) {
                $this->where($col, '=', $value, $boolean);
            }
            return $this;
        }
        [$value, $operator] = $this->prepareValueAndOperator(
            $value,
            $operator,
            func_num_args() === 2
        );

        if ($column instanceof Closure && is_null($operator)) {
            $column($query = new QueryBuilder($this->connection, $this->table, ''));
            return $this->addNestedWhereQuery($query->whereClause, $boolean);
        }

        if ($this->invalidOperator($operator)) {
            [$value, $operator] = [$operator, '='];
        }

        if (is_null($value)) {
            return $this->whereNull($column, $boolean, $operator !== '=');
        }

        $this->whereClause .= (empty($this->whereClause) ? '' : " $boolean ") . "$column $operator '$value'";

        return $this;
    }

    public function whereNull($columns, $boolean = 'and', $not = false)
    {
        $type = $not ? 'Not Null' : 'Null';
        $columns = is_array($columns) ? $columns : [$columns];

        foreach ($columns as $column) {
            $this->whereClause .= " $boolean $column is $type";
        }

        return $this;
    }

    public function whereNotNull($columns, $boolean = 'and'){
        return $this->whereNull($columns, $boolean, true);
    }

    public function orWhere($column, $operator = null, $value = null, $boolean = 'or')
    {
        return $this->where($column, $operator, $value, $boolean);
    }

    public function get()
    {
        $sql = "SELECT * FROM {$this->table}" . ($this->whereClause ? " WHERE {$this->whereClause}" : '');
        $result = $this->connection->query($sql);
        if(!$result) {
            throw new Exception($this->connection->error);
        }
        $records = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $records[] = $row;
            }
        }
        return $records;
    }

    public function first()
    {
        $sql = "SELECT * FROM {$this->table}" . ($this->whereClause ? " WHERE {$this->whereClause} LIMIT 1" : '');
        $result = $this->connection->query($sql);
        if(!$result) {
            throw new Exception($this->connection->error);
        }
        $records = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $records[] = $row;
            }
        }
        return reset($records);
    }

    public function find($id)
    {
        return $this->where('id', '=', $id)->first();
    }

    public function create(array $data) 
    {
        $data['created_at'] ??= date('Y-m-d H:i:s');
        $data['updated_at'] ??= date('Y-m-d H:i:s');

        $sql = "INSERT INTO {$this->table} SET ";
        foreach($data as $key => $value) {
            if(is_null($value)) {
                $value = 'NULL';
            } elseif(is_numeric($value)) {
                $value = $value;
            } else {
                $value = "'$value'";
            }
            $sql .= "$key = $value, ";
        }
        $sql = rtrim($sql, ', ');
        
        $result = $this->connection->query($sql);
        if($result) {
            return ORM::table($this->table)->where([
                'id' => $this->connection->insert_id
            ])->first();
        }
        throw new Exception($this->connection->error);
    }

    // You can add more methods here for additional query operations like updating, deleting, etc.
}

class ORM
{
    public $connection;

    public function __construct()
    {
        $dbConfig = config('database');
        // dd($dbConfig);
        $this->connection = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public static function table($table)
    {
        $orm = new ORM();
        return new QueryBuilder($orm->connection, $table, '');
    }
}
