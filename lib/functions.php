<?php 


/** 
 * Establish connection to the database
 * @return PDO  
 */
function getConnection() {
    $config = require 'config.php';

    $pdo = new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

/**
 * Fetch all pets from database
 * @param mixed $limit 
 * @return array|false 
 * @throws PDOException 
 */
function getPets($limit = null) {

    $pdo = getConnection();

    $query = 'SELECT * FROM pet';
    if ($limit) {
        $query = $query .' LIMIT :resultLimit';
    }
    $stmt = $pdo->prepare($query);
    if ($limit) {
        $stmt->bindParam('resultLimit', $limit, PDO::PARAM_INT);
    }
    $stmt->execute();
    $pets = $stmt->fetchAll();

    return $pets;
}

/**
 * Fetch specific pet data
 * @param mixed $id 
 * @return mixed 
 * @throws PDOException 
 */
function getPet($id) {
    $pdo = getConnection();
    $query = 'SELECT * FROM pet WHERE id = :idVal';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('idVal', $id);
    $stmt->execute();

    return $stmt->fetch();
}

/**
 * Save form input to database
 * @param mixed $petsToSave 
 * @return void 
 * @throws PDOException 
 */
function savePets($petsToSave) {

    // scan($petsToSave);die;
    // $json = json_encode($petsToSave, JSON_PRETTY_PRINT);
    // file_put_contents('data/pets.json', $json);
    $pdo = getConnection();
    
    // scan(end($petsToSave));die;

    $new = end($petsToSave);
    // scan($new);die;

    $name = $new['name'];
    $breed = $new['breed'];
    $weight = $new['weight'];
    $bio = $new['bio'];
    // scan($breed);die;

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO pet (name, breed, weight, bio) VALUES (:name, :breed, :weight, :bio)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':name' => $name,
        ':breed' => $breed,
        ':weight' => $weight,
        ':bio' => $bio
    ]);

    $id = $pdo->lastInsertId();
    echo 'Record inserted. Id: '.$id;    
}


/**
 * Analyse an organised array with colour
 * @param mixed $array 
 * @param string $name 
 * @return void 
 */
function scan($array, $name = 'var') {
    highlight_string("<?php\n\$$name =\n" . var_export($array, true) . ";\n?>");
}

