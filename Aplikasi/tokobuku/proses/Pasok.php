<?php
/**
 * @author Ferdy Sopian
 */

namespace APP;

require_once 'AbstractQuery.php';

/**
 * Class Pasok
 * @package APP
 */
class Pasok extends AbstractQuery
{
    public $idPasok;
    public $idDistributor;
    public $idBuku;
    public $jumlah;
    public $tglMasuk;
    public $tglKeluar;

    /**
     * Pasok constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $id
     */
    public function tampilBukSelected($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from buku where idBuku=" . $id);
        if ($koneksi->check_data()) {
            $data = $koneksi->show_data()[0];
            echo "<option value=\"" . $data['idBuku'] . "\">" . $data['judulBuku'] . "</option>";
        }
        $koneksi->close_database();
    }

    /**
     * @param $id
     */
    public function tampilDisSelected($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from distributor where idDistributor=" . $id);
        if ($koneksi->check_data()) {
            $data = $koneksi->show_data()[0];
            echo "<option value=\"" . $data['idDistributor'] . "\">" . $data['namaDistributor'] . "</option>";
        }
        $koneksi->close_database();
    }

    /**
     * @param $id
     */
    public function tampilDis($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from distributor");
        if ($koneksi->check_data()) {
            if ($id == 0) {
                foreach ($koneksi->show_data() as $key => $value) {
                    echo "<option value=\"" . $value['idDistributor'] . "\">" . $value['namaDistributor'] . "</option>";
                }
            } else {
                foreach ($koneksi->show_data() as $key => $value) {
                    echo "<option value=\"" . $value['idDistributor'] . "\" " . ($value['idDistributor'] == $id ? "selected" : "") . ">" . $value['namaDistributor'] . "</option>";
                }
            }
        }
        $koneksi->close_database();
    }

    /**
     * @param $id
     */
    public function tampilBuk($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from buku");
        if ($koneksi->check_data()) {
            if ($id == 0) {
                foreach ($koneksi->show_data() as $key => $value) {
                    echo "<option value=\"" . $value['idBuku'] . "\">" . $value['judulBuku'] . "</option>";
                }
            } else {
                foreach ($koneksi->show_data() as $key => $value) {
                    echo "<option value=\"" . $value['idBuku'] . "\" " . ($value['idBuku'] == $id ? "selected" : "") . ">" . $value['judulBuku'] . "</option>";
                }
            }
        }
        $koneksi->close_database();
    }

    /**
     *
     */
    public function select()
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from pasok join buku using(idBuku) join distributor using(idDistributor)");
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['namaDistributor'] . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['jumlah'] . "</td>" .
                     "<td>" . $value['tglMasuk'] . "</td>" .
                     "<td>" . $value['tglKeluar'] . "</td>" .
                     "<td>" .
                     ($value['tglKeluar'] == '0000-00-00' ? "<a href='proses/proses-edit.php?id=" . $value['idPasok'] . "&idDistributor=" . $value['idDistributor'] . "&idBuku=" . $value['idBuku'] . "&type=6'><button>KIRIM</button></a><a href='pasok.php?id=" . $value['idPasok'] . "&action=edit'><button>EDIT</button></a><a href='proses/proses-hapus.php?id=" . $value['idPasok'] . "&type=4' ><button>HAPUS</button></a>" : '') .
                     "</td>" .
                     "</tr>";
            }
        }
        $koneksi->close_database();
    }

    public function insert()
    {
        $koneksi = $this->connection();
        $koneksi->query("insert into pasok(idDistributor,idBuku,jumlah,tglMasuk,tglKeluar) values('" . $this->idDistributor . "','" . $this->idBuku . "','" . $this->jumlah . "','" . $this->tglMasuk . "','0000-00-00')");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../pasok.php');</script>";
        }
        $koneksi->close_database();
    }

    public function tambahPasok()
    {
        $koneksi = $this->connection();
        $koneksi->query("update pasok set idDistributor='" . $this->idDistributor . "',idBuku='" . $this->idBuku . "',jumlah=jumlah+" . $this->jumlah . ",tglMasuk='" . $this->tglMasuk . "',tglKeluar='" . $this->tglKeluar . "' where idPasok='" . $this->idPasok . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Pasok berhasil di tambah'); window.location.replace('../pasok.php');</script>";
        }
        $koneksi->close_database();

    }

    public function kirimStok()
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from pasok where idPasok=" . $this->idPasok);
        if ($koneksi->check_data()) {
            $data   = $koneksi->show_data()[0];
            $jumlah = $data['jumlah'];
            $koneksi->query("update buku set stok=stok+$jumlah where idBuku=" . $this->idBuku);
            $koneksi->query("update pasok set tglKeluar=DATE(NOW()) where idPasok=" . $this->idPasok);
            if ( ! $koneksi->mysqli()->errno) {
                echo "<script>alert('Stok berhasil di tambah'); window.location.replace('../pasok.php');</script>";

            }
        }
        $koneksi->close_database();
    }

    public function update()
    {
        $koneksi = $this->connection();
        $koneksi->query("update pasok set idDistributor='" . $this->idDistributor . "',idBuku='" . $this->idBuku . "',jumlah='" . $this->jumlah . "',tglMasuk='" . $this->tglMasuk . "',tglKeluar='" . $this->tglKeluar . "' where idPasok='" . $this->idPasok . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di update'); window.location.replace('../pasok.php');</script>";
        }
        $koneksi->close_database();
    }

    public function data($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from pasok where idPasok=" . $id);
        if ($koneksi->check_data()) {
            $data                = $koneksi->show_data()[0];
            $this->idPasok       = $id;
            $this->idDistributor = $data['idDistributor'];
            $this->idBuku        = $data['idBuku'];
            $this->jumlah        = $data['jumlah'];
            $this->tglMasuk      = $data['tglMasuk'];
            $this->tglKeluar     = $data['tglKeluar'];
        }
        $koneksi->close_database();
    }

    public function delete()
    {
        $koneksi = $this->connection();
        $koneksi->query("delete from pasok where idPasok='" . $this->idPasok . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di hapus'); window.location.replace('../pasok.php');</script>";
        }
        $koneksi->close_database();
    }
}
