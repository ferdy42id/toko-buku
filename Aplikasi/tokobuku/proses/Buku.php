<?php
/**
 * @author Ferdy Sopian
 */

namespace APP;

require_once 'AbstractQuery.php';

/**
 * Class Buku
 * @package APP
 */
class Buku extends AbstractQuery
{
    public $id;
    public $judul;
    public $noISBN;
    public $penulis;
    public $penerbit;
    public $tahunTerbit;
    public $stok;
    public $hargaPokok;
    public $hargaJual;
    public $PPN;
    public $diskon;

    /**
     * Buku constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $keywords
     */
    function search($keywords)
    {
        if (null == $keywords) {
            $keywords = " ";
        }
        $koneksi = $this->connection();
        $koneksi->query("select * from buku where judulBuku like '%" . $koneksi->mysqli()->real_escape_string($keywords) . "%' or penulis like '%" . $koneksi->mysqli()->real_escape_string($keywords) . "%' or tahunTerbit like '%" . $koneksi->mysqli()->real_escape_string($keywords) . "%'");
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['penulis'] . "</td>" .
                     "<td>" . $value['tahunTerbit'] . "</td>" .
                     "<td>Rp." . number_format($value['hargaJual'], 2, ',', '.') . "</td>" .
                     "<td>" . $value['PPN'] . "%</td>" .
                     "<td>" . $value['diskon'] . "%</td>" .
                     "<td>" . $value['stok'] . "</td>";
                if ($_SESSION['level'] == 'admin') {
                    echo "<td>
				<form action=\"proses/proses-input.php\" method=\"post\">
										<input style=\"display:block; width:100%;\" type=\"text\" name=\"jumlah\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
										<input type=\"hidden\" name=\"type\" value=\"5\">
										<input type=\"hidden\" name=\"idBuku\" value=\"" . $value['idBuku'] . "\">
						<input type=\"hidden\" name=\"idKasir\" value=\"$_SESSION[idKasir]\">
						<input style=\"display:block; width:100%;\" type=\"submit\" name=\"submit\" value =\"Tambah Keranjang\">
				</form>
				<a href='buku.php?id=" . $value['idBuku'] . "&action=edit'><button>EDIT</button></a>
				<a href='proses/proses-hapus.php?id=" . $value['idBuku'] . "&type=3' ><button>HAPUS</button></a>
				</td>";
                }
                "</tr>";
            }
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
        $koneksi->query("select * from buku where idBuku=" . $id);
        if ($koneksi->check_data()) {
            $data              = $koneksi->show_data()[0];
            $this->id          = $id;
            $this->judul       = $data['judulBuku'];
            $this->noISBN      = $data['noISBN'];
            $this->penulis     = $data['penulis'];
            $this->penerbit    = $data['penerbit'];
            $this->tahunTerbit = $data['tahunTerbit'];
            $this->stok        = $data['stok'];
            $this->hargaPokok  = $data['hargaPokok'];
            $this->hargaJual   = $data['hargaJual'];
            $this->PPN         = $data['PPN'];
            $this->diskon      = $data['diskon'];
        }
        $koneksi->close_database();

    }

    /**
     * @inheritDoc
     */
    public function delete()
    {
        $koneksi = $this->connection();
        $koneksi->query("delete from buku where idBuku='" . $this->id . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di hapus'); window.location.replace('../buku.php');</script>";
        } else {
            echo "<script>alert('Data gagal di hapus'); window.location.replace('../buku.php');</script>";
        }
        $koneksi->close_database();

    }

    /**
     * @inheritDoc
     */
    public function select()
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from buku");
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ( $key + 1 ) . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['penulis'] . "</td>" .
                     "<td>" . $value['tahunTerbit'] . "</td>" .
                     "<td>Rp." . number_format($value['hargaJual'], 2, ',', '.') . "</td>" .
                     "<td>" . $value['PPN'] . "%</td>" .
                     "<td>" . $value['diskon'] . "%</td>" .
                     "<td>" . $value['stok'] . "</td>";
                if ($_SESSION['level'] == 'admin') {
                    echo "<td>
				<a href='buku.php?id=" . $value['idBuku'] . "&action=edit'><button>EDIT</button></a>
				<a href='proses/proses-hapus.php?id=" . $value['idBuku'] . "&type=3' ><button>HAPUS</button></a>
				</td>";
                }
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
        $koneksi->query("insert into buku(judulBuku,noISBN,penulis,penerbit,tahunTerbit,stok,hargaPokok,hargaJual,PPN,diskon) values('" . $this->judul . "','" . $this->noISBN . "','" . $this->penulis . "','" . $this->penerbit . "','" . $this->tahunTerbit . "','" . $this->stok . "','" . $this->hargaPokok . "','" . $this->hargaJual . "','" . $this->PPN . "','" . $this->diskon . "')");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../buku.php');</script>";
        } else {
            echo "<script>alert('Data gagal di tambahkan'); window.location.replace('../buku.php');</script>";
        }
    }

    /**
     * @inheritDoc
     */
    public function update()
    {
        $koneksi = $this->connection();
        $koneksi->query("update buku set judulBuku='" . $this->judul . "',noISBN='" . $this->noISBN . "',penulis='" . $this->penulis . "',penerbit='" . $this->penerbit . "',tahunTerbit='" . $this->tahunTerbit . "',stok='" . $this->stok . "',hargaPokok='" . $this->hargaPokok . "',hargaJual='" . $this->hargaJual . "',PPN='" . $this->PPN . "',diskon='" . $this->diskon . "' where idBuku='" . $this->id . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di update'); window.location.replace('../buku.php');</script>";
        } else {
            echo "<script>alert('Data gagal di update'); window.location.replace('../buku.php');</script>";
        }
        $koneksi->close_database();
    }
}

?>
