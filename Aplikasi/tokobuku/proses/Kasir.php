<?php
/**
 * @author Ferdy Sopian
 */
require_once 'AbstractQuery.php';

/**
 * Class Kasir
 */
class Kasir extends AbstractQuery
{
    protected $id;
    protected $username;
    protected $password;
    protected $nama;
    protected $alamat;
    protected $telepon;
    protected $status;
    protected $level;

    /**
     * Kasir constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $koneksi = $this->connection();
        $koneksi->query("SELECT * FROM kasir WHERE username='" . $this->username . "'");
        if ($koneksi->check_data()) {
            $data = $koneksi->show_data()[0];
            if ($this->password == $data['password']) {
                if ($data['status'] == 0) {
                    echo "<script>alert('Anda sedang tidak aktif'); window.location.replace('../index.php');</script>";
                } else {
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['level']    = $data['level'];
                    $_SESSION['idKasir']  = $data['idKasir'];
                    echo "<script>alert('Login Berhasil'); window.location.replace('../index.php');</script>";
                }
            } else {
                echo "password salah";
            }
        }
        $koneksi->close_database();
    }

    /**
     * @inheritDoc
     */
    public function select()
    {
        $koneksi = $this->connection();
        $koneksi->query('select * from kasir');
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['nama'] . "</td>" .
                     "<td>" . $value['alamat'] . "</td>" .
                     "<td>" . $value['telepon'] . "</td>" .
                     "<td>" . $value['level'] . "</td>" .
                     "<td>" . $value['username'] . "</td>";
                if ($value['status'] == 1) {
                    echo "<td><a href='proses/proses-edit.php?id=" . $value['idKasir'] . "&type=7&status=0'><button>ON</button></a></td>";
                } else {
                    echo "<td><a href='proses/proses-edit.php?id=" . $value['idKasir'] . "&type=7&status=1'><button>OFF</button></a></td>";
                }
                echo "<td>
                <a href='kasir.php?id=" . $value['idKasir'] . "&action=edit'><button>EDIT</button></a>
                <a href='proses/proses-hapus.php?id=" . $value['idKasir'] . "&type=2'><button>HAPUS</button></a>
                </td>" .
                     "</tr>";
            }
        }
        $koneksi->close_database();
    }

    public function ubahStatus()
    {
        $koneksi = $this->connection();
        $koneksi->query("update kasir set status=" . $this->__get('status') . " where idKasir=" . $this->__get('id'));
        if ($koneksi->mysqli()->query) {
            echo "<script>window.location.replace('../kasir.php');</script>";
        }
        $koneksi->close_database();
    }

    /**
     * @inheritDoc
     */
    public function update()
    {
        $koneksi = $this->connection();
        $koneksi->query("update kasir set nama='" . $this->nama . "',alamat='" . $this->alamat . "',telepon='" . $this->telepon . "',status='" . $this->status . "',level='" . $this->level . "',username='" . $this->username . "',password='" . $this->password . "' where idKasir='" . $this->id . "'");
        if ($koneksi->mysqli()->query) {
            echo "<script>alert('Data berhasil di update'); window.location.replace('../kasir.php');</script>";
        }
        $koneksi->close_database();
    }

    /**
     * @inheritDoc
     */
    public function delete()
    {
        $koneksi = $this->connection();
        $koneksi->query("delete from kasir where idKasir='" . $this->id . "'");
        if ($koneksi->mysqli()->query) {
            echo "<script>alert('Data berhasil di hapus'); window.location.replace('../kasir.php');</script>";
        }
        $koneksi->close_database();
    }

    /**
     * @param $id
     *
     * @inheritDoc
     */
    public function data($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from kasir where idKasir=" . $id);
        if ($koneksi->check_data()) {
            $data           = $koneksi->show_data()[0];
            $this->id       = $data['idKasir'];
            $this->nama     = $data['nama'];
            $this->alamat   = $data['alamat'];
            $this->telepon  = $data['telepon'];
            $this->status   = $data['status'];
            $this->level    = $data['level'];
            $this->username = $data['username'];
            $this->password = $data['password'];
        }
        $koneksi->close_database();
    }

    /**
     * @inheritDoc
     */
    public function insert()
    {
        $koneksi = $this->connection();
        $koneksi->query("insert into kasir(nama,alamat,telepon,status,level,username,password) values('" . $this->__get('nama') . "','" . $this->__get('alamat') . "','" . $this->__get('telepon') . "','" . $this->__get('status') . "','" . $this->__get('level') . "','" . $this->__get('username') . "','" . $this->__get('password') . "')");
        if ($koneksi->mysqli()->query) {
            echo "<script>alert('Simpan Password anda : " . $this->__get('password') . "'); window.location.replace('../kasir.php');</script>";
        }
        $koneksi->close_database();
    }
}
