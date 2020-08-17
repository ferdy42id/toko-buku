<?php
/**
 * @author Ferdy Sopian
 */

namespace APP;

require_once "config/Data.php";

use APP\Config\Data;

/**
 * Class AbstractQuery
 * @package APP
 */
abstract class AbstractQuery
{
    /**
     * @var Data
     */
    private $data;

    /**
     * AbstractQuery constructor.
     */
    protected function __construct()
    {
        $this->data = new Data('root', 'root', 'localhost');
    }

    /**
     * Use this instead initialize everytime
     *
     * @return Data
     */
    public function connection()
    {
        if (null === $this->data->mysqli()) {
            $this->data->connect();
        }

        return $this->data;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->{$name});
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (isset($this->{$name})) {
            $this->{$name} = $value;
        }
    }

    /**
     * This should use to select data from database
     *
     * @return mixed
     */
    abstract protected function select();

    /**
     * This should use to insert data from database
     *
     * @return mixed
     */
    abstract protected function insert();

    /**
     * This should use to update data from database
     *
     * @return mixed
     */
    abstract protected function update();

    /**
     * This should use to delete data from database
     *
     * @return mixed
     */
    abstract protected function delete();

    /**
     * This should use to set data from database
     *
     * @param $id
     *
     * @return mixed
     */
    abstract protected function data($id);
}
