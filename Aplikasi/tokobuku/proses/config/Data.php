<?php
/**
 * @author Ferdy Sopian
 */
include "Database.php";

/**
 * Class Data
 */
class Data extends Database
{
    /**
     * Data constructor.
     *
     * @param $user
     * @param $pass
     * @param $host
     * @param string $database
     */
    public function __construct($user, $pass, $host, $database = '')
    {
        parent::__construct($user, $pass, $host, $database);
    }

    /**
     * We need to override mysqli_result()->fetch_assoc() so it will match our need
     *
     * @return array
     */
    public function show_data()
    {
        $data = array();
        if ($this->check_data()) {
            while ($row = $this->query->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * Checking is data available
     *
     * @return bool
     */
    public function check_data()
    {
        return $this->count_rows() > 0;
    }

    /**
     * Simplify the code instead direct access to mysqli()
     *
     * @return int
     */
    public function count_rows()
    {
        if (is_object($this->query)) {
            return $this->query->num_rows;
        }

        return 0;
    }
}
