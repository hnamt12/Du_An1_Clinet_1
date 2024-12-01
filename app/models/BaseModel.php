<?php
namespace App\Models;
use PDO;
use PDOException;
class BaseModel
{

    protected $table;
    protected $pdo;

    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);
        try {

            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            //throw $th;
            die("Kết nối cơ sở dữ liệu thất bại : {$e->getMessage()}. Vui lòng thử và kiểm tra lại !");
        }
    }
    public function __destruct()
    {
        $this->pdo = null;
    }

    //  khi dùng : $ojec ->select('id,name','id>:id AND price >:price ,['id'=>3 ,'price' => 36000])
    public function select($columns = '*', $conditions = null, $params = [])
    {
        $sql = "SELECT $columns FROM {$this->table}";
        if ($conditions) {
            $sql .= " WHERE $conditions ";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }



    public function count($conditions = null, $params = [])
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        if ($conditions) {
            $sql .= " WHERE $conditions ";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchColumn();
    }


    // Phân trang 

    public function paginate($page = 1 , $perPage = 5 , $columns = '*', $conditions = null, $params = [])
    {


        // $page : số trang hiện tại 
        // $perPage : số lượng bản ghi trên 1 trang 
        $sql = "SELECT $columns FROM {$this->table}";
        if ($conditions) {
            $sql .= " WHERE $conditions ";
        }

        $offset = ($page-1)*$perPage ;

        $sql.= "LIMIT $perPage OFFSET $offset" ; 

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

// lấy 1 bẳng ghi 
    public function find($columns = '*', $conditions = null, $params = [])
    {
        $sql = "SELECT $columns FROM {$this->table}";
        if ($conditions) {
            $sql .= " WHERE $conditions ";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
       

        return $stmt->fetch();
    }

    public function insert($data)
    {
        $keys = array_keys($data) ; 
        $columns = implode(',',$keys) ; 
        $placeholders = ':' .implode(', :',$keys) ; 
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $this->pdo->lastInsertId();
    }
    public function delete($conditions = null, $params = [])
    {
        $sql = "DELETE FROM {$this->table}";
        
        if ($conditions) {
            $sql .= " WHERE $conditions";
        }
        
        $stmt = $this->pdo->prepare($sql);
       
        $stmt->execute($params);
        // debug($stmt); 
        // die ;
        return $stmt->rowCount();
    }
    function deleteid($id)
    {
        try {
            $sql =" 
            DELETE FROM users WHERE id = :id " ;


            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id',$id) ;
            $stmt->execute();


            return $stmt->fetchAll();
        }catch (\Exception $e) {
            //throw $th;
            debug($e);
        }
    }


    public function update($data, $conditions = null, $params = [])
    {
        $sets = implode(',',array_map(fn($key)=>"$key = :set_$key",array_keys($data)));

        $sql = "UPDATE {$this->table} SET $sets";
        if ($conditions) {
            $sql .= " WHERE $conditions ";
        }
        $stmt = $this->pdo->prepare($sql);
        // bindParam trong set
        foreach($data as $key =>&$value){
            $stmt->bindParam(":set_$key",$value)    ;
        }
                // bindParam trong where

        foreach($params as $key =>&$value){
            $stmt->bindParam(":$key",$value)    ;
        }
        $stmt->execute();

        return $stmt->rowCount();
    }
   

   
    // function getConnect()
    // {
    //     $pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME .
    //         ";charset=" . DBCHARSET, DBUSER, DBPASS);
    //     return $pdo;
    // }

    // // Hàm lấy nhiều dòng dữ liệu
    // function getAllData($query)
    // {
    //     // $pdo = getConnect();         
    //     try {
    //         $pdo = $this->getConnect();
    //         if ($pdo !== null) {
    //             $stmt = $pdo->prepare($query);
    //             $stmt->execute();
    //             return $stmt->fetchAll();
    //         } else {
    //             return null;
    //         }
    //     } catch (PDOException $e) {
    //         echo "Lỗi truy vấn: " . $e->getMessage();
    //         return null;
    //     }
    // }

    // // Hàm lấy một dòng dữ liệu
    // function getRowData($query)
    // {
    //     try {
    //         $pdo = $this->getConnect();
    //         $stmt = $pdo->prepare($query);
    //         $stmt->execute();
    //         return $stmt->fetch();
    //     } catch (PDOException $e) {
    //         echo "Lỗi truy vấn: " . $e->getMessage();
    //         return null;
    //     }
    // }


}



