<?php
/**
 * @author Ferdy Sopian
 */

namespace APP;

require_once 'AbstractQuery.php';

/**
 * Class Distributor
 * @package APP
 */
class Distributor extends AbstractQuery
{
    public $id;
    public $namaDistributor;
    public $alamat;
    public $telepon;

    /**
     * Distributor constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function select()
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from distributor");
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['namaDistributor'] . "</td>" .
                     "<td>" . $value['alamat'] . "</td>" .
                     "<td>" . $value['telepon'] . "</td>" .
                     "<td>
			<a href='distributor.php?id=" . $value['idDistributor'] . "&action=edit'><button>EDIT</button></a>
			<a href='proses/proses-hapus.php?id=" . $value['idDistributor'] . "&type=1' ><button>HAPUS</button></a>
			</td>" .
                     "</tr>";
            }
        }
        $koneksi->close_database();
    }

    /**
     * @inheritDoc
     */
    public function insert()
    {
        $koneksi = $this->connection();
        $koneksi->query("insert into distributor(namaDistributor,alamat,telepon) values('" . $this->namaDistributor . "','" . $this->alamat . "','" . $this->telepon . "')");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../distributor.php');</script>";
        } else {
            echo "<script>alert('Data gagal di tambahkan'); window.location.replace('../distributor.php');</script>";
        }
        $koneksi->close_database();

    }

    /**
     * @inheritDoc
     */
    public function update()
    {
        $koneksi = $this->connection();
        $koneksi->query("update distributor set namaDistributor='" . $this->namaDistributor . "',alamat='" . $this->alamat . "',telepon='" . $this->telepon . "' where idDistributor='" . $this->id . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di update'); window.location.replace('../distributor.php');</script>";
        } else {
            echo "<script>alert('Data gagal di update'); window.location.replace('../distributor.php');</script>";
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
        $koneksi->query("select * from distributor where idDistributor=" . $id);
        if ($koneksi->check_data()) {
            $data                  = $koneksi->show_data()[0];
            $this->id              = $data['idDistributor'];
            $this->namaDistributor = $data['namaDistributor'];
            $this->alamat          = $data['alamat'];
            $this->telepon         = $data['telepon'];
        }
        $koneksi->close_database();
    }

    /**
     * @inheritDoc
     */
    public function delete()
    {
        $koneksi = $this->connection();
        $koneksi->query("update distributor set namaDistributor='" . $this->namaDistributor . "',alamat='" . $this->alamat . "',telepon='" . $this->telepon . "' where idDistributor='" . $this->id . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di hapus'); window.location.replace('../distributor.php');</script>";
        } else {
            echo "<script>alert('Data gagal di hapus'); window.location.replace('../distributor.php');</script>";
        }
        $koneksi->close_database();
    }
}

