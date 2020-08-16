<?php
/**
 * @author Ferdy Sopian
 */

/**
 * Class Database
 */
class Database
{

    /**
     * Store the query
     *
     * @var mysqli_result|bool
     */
    protected $query;
    /**
     * Store database user
     *
     * @var string
     */
    private $user;
    /**
     * Store database password
     *
     * @var string
     */
    private $pass;
    /**
     * Store database name
     *
     * @var string
     */
    private $database = 'dbtokobuku';
    /**
     * Store database host
     *
     * @var string
     */
    private $host;
    /**
     * connection to the MySQL server
     *
     * @var mysqli|false
     */
    private $db;

    /**
     * Database constructor.
     *
     * @param $user
     * @param $pass
     * @param $host
     * @param string $database
     */
    protected function __construct($user, $pass, $host, $database = '')
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->host = $host;
        if ('' !== $database) {
            $this->database = $database;
        }
        $this->connect();
    }

    /**
     * Sometimes we need to connect database again
     */
    public function connect()
    {
        if (! empty($this->user) && ! empty($this->pass) && ! empty($this->database) && ! empty($this->host)) {
            $this->db = new mysqli($this->host, $this->user, $this->pass, $this->database);
            if ($this->db->connect_errno > 0) {
                die('Koneksi Gagal : ' . $this->db->connect_error);
            }

            return;
        }
        die('Koneksi Gagal : data ada yang kosong');
    }

    /**
     * The connection to the MySQL server
     *
     * @return false|mysqli
     */
    public function mysqli()
    {
        return $this->db;
    }

    /**
     * We need to override mysqli()->query instead
     *
     * @param $sql
     */
    public function query($sql)
    {
        $this->connect();
        $this->query = $this->db->query($sql);
        if (! $this->query) {
            die('Koneksi Gagal : ' . $this->db->error);
        }
    }

    /**
     * Sometimes we need to close the connection
     */
    public function close_database()
    {
        $this->db->close();
    }
}
