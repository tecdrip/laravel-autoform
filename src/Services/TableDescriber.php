<?php
namespace Tecdrip\LaravelAutoForm\Services;

use DB;

class TableDescriber {
    public $index = [];
    public $columns = [];

    function __construct($tableName)
    {
        $columOverrides = config('autoform.column_override');
        $columnRelationships = config('autoform.column_relationships');

        $this->columns = DB::select("describe $tableName");

        foreach($this->columns as &$column) {
            $model = @$columnRelationships[$column->Field];
            if(@$model) {
                $model = resolve($model);

                $canUse = in_array('name', $model->getFillable());
                if($canUse) {
                    $column->Model = $model;
                }
            }

            $column->FieldDisplayName = ucwords(str_replace("_", " ", $column->Field));
            $column->Type = $this->formatType($column->Type);

            //column override lol
            if(@$columOverrides[$tableName]); {
                if(@$columOverrides[$tableName][$column->Field]) {
                    $column->Type['name'] = $columOverrides[$tableName][$column->Field]['type'];
                    if($columOverrides[$tableName][$column->Field]['type']) {
                        $column->Options = $columOverrides[$tableName][$column->Field]['options'];
                    }
                }
            }
        }

        $orderSchemas = config('autoform.column_ordering');
        $schema = @$orderSchemas[$tableName];

        $this->removeBadColumns();
        $this->createIndex($schema);
    }

    private function getColumnByName($name)
    {
        foreach($this->columns as $column) {
            if($column->Field == $name) {
                return $column;
            }
        }

        return false;
    }

    private function createIndex($schema = [])
    {
        $index = [];
        $indexedColumnNames = [];

        if(!$schema) {
            $schema = [];
        }

        foreach($schema as $order) {
            if(is_array($order)) {
                $chunk = [];
                foreach($order as $columnName) {
                    $column = $this->getColumnByName($columnName);
                    if($column) {
                        $chunk[] = $column;
                        $indexedColumnNames[] = $columnName;
                    }
                }

                if($chunk) {
                    $index[] = $chunk;
                }
            }else{
                $column = $this->getColumnByName($order);
                if($column) {
                    $index[] = $column;
                    $indexedColumnNames[] = $order;
                }
            }
        }

        $chunk = [];
        //add non ordered columns
        foreach($this->columns as $column) {

            if(!in_array($column->Field, $indexedColumnNames)) {
                //column has not been added to the ind
                $chunk[] = $column;
            }

            if(count($chunk) >= 2) {
                $index[] = $chunk;
                $chunk = [];
            }
        }

        //purge chunk
        if($chunk) {
            $index[] = $chunk;
        }

        $this->index = $index;
    }

    private function removeBadColumns()
    {
        $badColumns = [
            'id',
            'created_at',
            'updated_at',
            'email_verified_at',
            'remember_token'
        ];

        $this->columns = array_map(function($col) use($badColumns) {
            if(in_array($col->Field, $badColumns)) {
                return false;
            }

            return $col;
        }, $this->columns);

        $this->columns = array_filter($this->columns);
    }

    private function formatType($rawType)
    {
        $rawType = explode(" ", $rawType)[0];

        preg_match('/([a-zA-Z\s]*)\((.*)\)$/', $rawType , $type);

        if(!@$type[1]) {
            return false;
        }

        return [
            'name' => $type[1],
            'raw' => $type[0],
            'length' => $type[2]
        ];
    }
}
?>
