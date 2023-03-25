<?php 
class Event implements JsonSerializable{
    private $id;
    private $name;
    private $description;
    private $presenter;
    private $date;
    private $time;

    function get_id() {
        return $this->id;
    }  
    function get_name() {
        return $this->name;
    }
    function get_desc() {
        return $this->description;
    }
    function get_presenter() {
        return $this->presenter;
    }
    function get_date() {
        return $this->date;
    }
    function get_time() {
        return $this->time;
    }

    function set_id($id) {
        $this->id = $id;
    }
    function set_name($name) {
        $this->name = $name;
    }
    function set_desc($description) {
        $this->description = $description;
    }
    function set_presenter($presenter) {
        $this->presenter = $presenter;
    }
    function set_date($date) {
        $this->date = $date;
    }
    function set_time($time) {
        $this->time = $time;
    }
	/**
	 * Specify data which should be serialized to JSON
	 * Serializes the object to a value that can be serialized natively by json_encode().
	 * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource .
	 */
	public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
	}
}

$host = "localhost";
$dbname = "wdv341";
$username = "persist_app_user";
$password = "Wizard101!2";

$conn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($conn, $username, $password);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}

$toSearch = 1;

$sql = 'SELECT * FROM wdv341_events WHERE id = :someID';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':someID', $toSearch);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$outputObj = new Event();

$outputObj->set_name($result['name']);
$outputObj->set_id($result['id']);
$outputObj->set_desc($result['description']);
$outputObj->set_presenter($result['presenter']);
$outputObj->set_date($result['date']);
$outputObj->set_time($result['time']);

$outputObj = json_encode($outputObj);

echo $outputObj;

$pdo = null;
?>
