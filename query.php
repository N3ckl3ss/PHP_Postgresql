 <?php
error_reporting(E_ALL);

class dbObj
{
    var $servername = "localhost";
    var $username = "gp6khz";
    var $password = "gp6khz";
    var $dbname = "gp6khz";
    var $port = "5432";
    var $conn;
    function getConnstring()
    {
        $con = pg_connect("host=" . $this->servername . " port=" . $this->port . " dbname=" . $this->dbname . " user=" . $this->username . " password=" . $this->password . "") or die("Connection failed: " . pg_last_error());

        /* check connection */
        if (pg_last_error()) {
            printf("Connect failed: %s\n", pg_last_error());
            exit();
        } else {
            $this->conn = $con;
        }
        return $this->conn;
    }
}


//geting all from the shows,actors and channels and ordering  
class Channel1{

    protected $conn;
    protected $data = array();
    function __construct()
    {

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $this->conn = $connString;
    }


    public function getChannel1Shows()
    {
        $sql ="SELECT s.show_id,s.show_start,s.show_name,s.show_img,s.show_details,a.actor_name FROM shows AS s JOIN channels AS c ON s.channel_id=c.channel_id JOIN actors AS a ON a.actor_id=s.actor_id WHERE c.channel_name='BBC' ORDER BY s.show_start ASC;";
        $queryRecords = pg_query($this->conn, $sql) or die("Error during query!");
        $data = pg_fetch_all($queryRecords);
        return $data;
    }

}
class Channel2{
    protected $conn;
    protected $data = array();
    function __construct()
    {

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $this->conn = $connString;
    }


    public function getChannel2Shows()
    {
        $sql ="SELECT s.show_id,s.show_start,s.show_name,s.show_img,s.show_details,a.actor_name FROM shows AS s JOIN channels AS c ON s.channel_id=c.channel_id JOIN actors AS a ON a.actor_id=s.actor_id WHERE c.channel_name='BBC Two' ORDER BY s.show_start ASC;";
        $queryRecords = pg_query($this->conn, $sql) or die("Error during query!");
        $data = pg_fetch_all($queryRecords);
        return $data;
    }
}
class Channel3{
    protected $conn;
    protected $data = array();
    function __construct()
    {

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $this->conn = $connString;
    }


    public function getChannel3Shows()
    {
        $sql ="SELECT s.show_id,s.show_start,s.show_name,s.show_img,s.show_details,a.actor_name FROM shows AS s JOIN channels AS c ON s.channel_id=c.channel_id JOIN actors AS a ON a.actor_id=s.actor_id WHERE c.channel_name='BBC Three' ORDER BY s.show_start ASC;";
        $queryRecords = pg_query($this->conn, $sql) or die("Error during query!");
        $data = pg_fetch_all($queryRecords);
        return $data;
    }
}
//Admin page tables
class Shows{
    protected $conn;
    protected $data = array();
    function __construct()
    {

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $this->conn = $connString;
    }


    public function getShows()
    {
        $sql ="SELECT s.show_id,s.show_start,s.show_name,s.show_img,s.show_details,a.actor_name,c.channel_name FROM shows AS s JOIN channels AS c ON s.channel_id=c.channel_id JOIN actors AS a ON a.actor_id=s.actor_id ORDER BY s.show_start ASC;";
        $queryRecords = pg_query($this->conn, $sql) or die("Error during query!");
        $data = pg_fetch_all($queryRecords);
        return $data;
    }
}
class NotUsedActors{
    protected $conn;
    protected $data = array();
    function __construct()
    {

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $this->conn = $connString;
    }


    public function getNotUsedActors()
    {
        $sql ="SELECT * FROM actors WHERE actor_id NOT IN(SELECT actor_id FROM shows) ";
        $queryRecords = pg_query($this->conn, $sql) or die("Error during query!");
        $data = pg_fetch_all($queryRecords);
        return $data;
    }
}
//list for the "My List" page
class UserList{
    protected $conn;
    protected $data = array();
    function __construct()
    {

        $db = new dbObj();
        $connString =  $db->getConnstring();
        $this->conn = $connString;
    }

    public function getUserList()
    {
        $sql = "SELECT * FROM my_list AS l JOIN shows AS s ON s.show_id=l.show_id  JOIN account AS u ON u.username=l.user_n ORDER BY s.show_start ASC;";
        $queryRecords = pg_query($this->conn, $sql) or die("Error during query!");
        $data = pg_fetch_all($queryRecords);
        return $data;
    }
}
