<?php
namespace App\Models\Contracts;

use App\Models\Contracts\BaseModel;
use Medoo\Medoo;
class mysqlBaseModel extends BaseModel{

    

    public function __construct()
    {
        try {
            $this->connection = new Medoo([
                // [required]
                'type' => 'mysql',
                'host' => $_ENV['DBHOST'],
                'database' => $_ENV['DBNAME'],
                'username' => $_ENV['DBUSER'],
                'password' => $_ENV['DBPASS'],
             
                // [optional]
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_general_ci',
                'port' => 3306,
             
                // [optional] The table prefix. All table names will be prefixed as PREFIX_table.
                'prefix' => '',
             
                // [optional] To enable logging. It is disabled by default for better performance.
                'logging' => true,
             
                // [optional]
                // Error mode
                // Error handling strategies when the error has occurred.
                // PDO::ERRMODE_SILENT (default) | PDO::ERRMODE_WARNING | PDO::ERRMODE_EXCEPTION
                // Read more from https://www.php.net/manual/en/pdo.error-handling.php.
                'error' => \PDO::ERRMODE_EXCEPTION,
             
                
            ]);
        }catch(\Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
       

    }

    public function create(array $data) : int{

        $data = $this->connection->insert($this->table,$data);
        return $data->rowCount();  
    }

    public function find($id) : object{
        return (object) array();
    }

    public function get( $columns, array $where = []) : array
    {
        $data = $this->connection->select($this->table, $columns, $where);

        return $data;
    }

    public function getByColumn(array $columns, array $where = []) : array {

        $data = $this->connection->select($this->table, $columns, $where);
        return $data;
    }

    public function update(array $data, array $where) : int{
        return 1;
    }

    public function delete(array $where) : int{
        return 1;
    }

}