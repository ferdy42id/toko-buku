<?php
/**
 * @author Ferdy Sopian
 */

namespace APP;

require_once 'AbstractQuery.php';

/**
 * Class Penjualan
 * @package APP
 */
class Penjualan extends AbstractQuery
{
    public $idPenjualan;
    public $noTransaksi;
    public $idBuku;
    public $idKasir;
    public $namaKasir;
    public $jumlah;
    public $totalBayar;
    public $tglTransaksi;
    public $status;

    /**
     * Penjualan constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function tampilKasir()
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from kasir");
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<option value=\"" . $value['idKasir'] . "\">" . $value['nama'] . "</option>";
            }
        }
        $koneksi->close_database();
    }

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

    public function bayar()
    {
        $koneksi = $this->connection();
        $koneksi->query("update penjualan set noTransaksi='" . $this->noTransaksi . "'  where status=0 and idKasir='" . $this->idKasir . "'");
        $koneksi->close_database();
    }

    public function konfirmasiBayar()
    {
        $koneksi = $this->connection();
        $koneksi->query("update penjualan set status=1, tglTransaksi=NOW() where noTransaksi='" . $this->noTransaksi . "' and status=0 and idKasir='" . $this->idKasir . "'");
        $koneksi->close_database();
    }

    public function prosesBayar()
    {
        $koneksi = $this->connection();
        $koneksi->query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where noTransaksi='" . $this->noTransaksi . "' and penjualan.status=0");
        $totalBayar = 0;
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['noISBN'] . "</td>" .
                     "<td>Rp." . number_format($value['hargaJual'], 0, 0, '.') . ",-</td>" .
                     "<td>" . $value['jumlah'] . " buah</td>" .
                     "<td>" . $value['PPN'] . "%</td>" .
                     "<td>" . $value['diskon'] . "%</td>" .
                     "<td>Rp." . number_format($value['totalBayar'], 0, 0, '.') . ",-</td>" .
                     "</tr>";
                $totalBayar += $value['totalBayar'];
            }
        }
        echo "<tr>" .
             "<th colspan=\"7\"></th>" .
             "<th>Rp." . number_format($totalBayar, 0, 0, '.') . ",-</th>" .
             "</tr>" .
             "<th colspan=\"8\"><a href=\"pembayaran.php?action=konfirmasipembayaran&noTransaksi=" . $this->noTransaksi . "\"><button>Bayar</button></a></th>" .
             "</tr>";
        $koneksi->close_database();
    }

    public function prosesCetak()
    {
        $koneksi = $this->connection();
        $koneksi->query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where noTransaksi='" . $this->noTransaksi . "' and penjualan.status=1");
        $totalBayar = 0;
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['noISBN'] . "</td>" .
                     "<td>Rp." . number_format($value['hargaJual'], 0, 0, '.') . ",-</td>" .
                     "<td>" . $value['jumlah'] . " buah</td>" .
                     "<td>" . $value['PPN'] . "%</td>" .
                     "<td>" . $value['diskon'] . "%</td>" .
                     "<td>Rp." . number_format($value['totalBayar'], 0, 0, '.') . ",-</td>" .
                     "</tr>";
                $totalBayar += $value['totalBayar'];
            }
        }
        echo "<tr>" .
             "<th colspan=\"7\"></th>" .
             "<th>Rp." . number_format($totalBayar, 0, 0, '.') . ",-</th>" .
             "</tr>" .
             "<th colspan=\"8\"><a href=\"cetak.php?action=cetaknota&noTransaksi=" . $this->noTransaksi . "\"><button>Cetak</button></a></th>" .
             "</tr>";
        $koneksi->close_database();
    }

    public function cetakNota()
    {
        $koneksi = $this->connection();
        $koneksi->query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where noTransaksi='" . $this->noTransaksi . "' and penjualan.status=1");
        $totalBayar = 0;
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['noISBN'] . "</td>" .
                     "<td>Rp." . number_format($value['hargaJual'], 0, 0, '.') . ",-</td>" .
                     "<td>" . $value['jumlah'] . " buah</td>" .
                     "<td>" . $value['PPN'] . "%</td>" .
                     "<td>" . $value['diskon'] . "%</td>" .
                     "<td>Rp." . number_format($value['totalBayar'], 0, 0, '.') . ",-</td>" .
                     "</tr>";
                $totalBayar += $value['totalBayar'];
            }
        }
        echo "<tr>" .
             "<th colspan=\"7\"></th>" .
             "<th>Rp." . number_format($totalBayar, 0, 0, '.') . ",-</th>" .
             "</tr>";
        $koneksi->close_database();
    }

    public function insert()
    {
        $koneksi = $this->connection();
        $koneksi->query("select * from buku where idBuku='" . $this->idBuku . "'");
        if ($koneksi->check_data()) {
            $data       = $koneksi->show_data()[0];
            $jumlahAwal = $data['stok'];
            $koneksi->query("select * from penjualan where idBuku='" . $this->idBuku . "'");
            if ($koneksi->check_data()) {
                $data        = $koneksi->show_data()[0];
                $jumlahPesan = $data['jumlah'];
                if (($jumlahAwal - $jumlahPesan) - $this->jumlah <= 0) {
                    echo "<script>alert('Stok tidak cukup'); window.location='../penjualan.php';</script>";
                } else {
                    $koneksi->query("select * from penjualan where idBuku='" . $this->idBuku . "' and status=0 and idKasir='" . $this->idKasir . "'");
                    if ($koneksi->check_data()) {
                        $koneksi->query("update penjualan join buku using(idBuku) set jumlah=jumlah+" . $this->jumlah . ", 
					totalBayar=(
						(hargaJual*(jumlah+" . $this->jumlah . "))+
						(hargaJual*(jumlah+" . $this->jumlah . ")*(PPN/100))-
						(hargaJual*(jumlah+" . $this->jumlah . ")*(diskon/100))
					) where idBuku='" . $this->idBuku . "' and status=0 and idKasir='" . $this->idKasir . "'");
                    } else {
                        $koneksi->query("insert into penjualan(noTransaksi,tglTransaksi,idBuku,idKasir,jumlah,totalBayar,status) values('','0000-00-00','" . $this->idBuku . "','" . $this->idKasir . "','" . $this->jumlah . "',
					(select (hargaJual*" . $this->jumlah . ")+
					((hargaJual*" . $this->jumlah . ")*(PPN/100))-
					((hargaJual*" . $this->jumlah . ")*(diskon/100)) from buku where idBuku='" . $this->idBuku . "'),0)");
                    }
                    if ( ! $koneksi->mysqli()->errno) {
                        echo "<script>alert('Pemesanan berhasil dimasukan'); window.location.replace('../penjualan.php?action=input');</script>";
                    }
                }
            }
        }
        $koneksi->close_database();
    }

    public function select()
    {
        $koneksi = $this->connection();
        $koneksi->query("select *, penjualan.status as statusPenjualan from penjualan join buku using(idBuku) join kasir using(idKasir) where penjualan.status=0 and idKasir=" . $this->idKasir);
        $totalBayar = 0;
        $kode       = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $acak       = substr(str_shuffle($kode), 0, 4) . date('Y-m');
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['idPenjualan'] . "</td>" .
                     "<td>" . $value['noTransaksi'] . "</td>" .
                     "<td>" . $value['judulBuku'] . "</td>" .
                     "<td>" . $value['nama'] . "</td>" .
                     "<td>" . $value['jumlah'] . "</td>" .
                     "<td>Rp." . number_format($value['totalBayar'], 2, ",", ".") . "</td>" .
                     "<td>
			<a href='proses/proses-hapus.php?id=" . $value['idPenjualan'] . "&type=5' ><button>HAPUS</button></a>
			</td>" .
                     "</tr>";
                $totalBayar += $value['totalBayar'];
            }
        }
        echo "<tr style=\"background-color: #555; color:#fff;\">" .
             "<th colspan=\"7\" style=\"text-align:right;\">Total Harga	:</th>" .
             "<th>Rp." . number_format($totalBayar, 2, ",", ".") . "</th>" .
             "</tr>" .
             "<tr style=\"background-color: #555; color:#fff;\">" .
             "<th colspan=\"7\" style=\"text-align:right;\"></th>" .
             "<th>
		<a href=\"pembayaran.php?action=pembayaran&noTransaksi=$acak\" target=\"_blank\"><button>Pembayaran</button></a>
		</th>" .
             "</tr>";
        $koneksi->close_database();
    }

    public function tampilLaporanCari($idKasir, $awal, $tujuan)
    {
        $koneksi = $this->connection();
        if ($idKasir == 0 && $awal == 0 && $tujuan == 0) {
            $query = "select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 group by noTransaksi";
        } elseif ($awal == 0 && $tujuan == 0) {
            $query = "select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=" . $idKasir . " group by noTransaksi";
        } else {
            $query = "select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=" . $idKasir . " and (tglTransaksi between '$awal' and '$tujuan') group by noTransaksi";
        }
        $koneksi->query($query);
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['nama'] . "</td>" .
                     "<td>" . $value['noTransaksi'] . "</td>" .
                     "<td>" . $value['tglTransaksi'] . "</td>" .
                     "<td>" . $value['SUM(jumlah)'] . "</td>" .
                     "<td>Rp." . number_format($value['SUM(totalBayar)'], 2, ",", ".") . "</td>" .
                     "<td>
			<a href='cetak.php?action=cetaknota&noTransaksi=" . $value['noTransaksi'] . "' target=\"_blank\" ><button>Detail</button></a>
			</td>" .
                     "</tr>";
            }
        }
        $koneksi->close_database();
    }

    public function tampilLaporanCariPrint($idKasir, $awal, $tujuan)
    {
        $koneksi = $this->connection();
        if ($idKasir == 0 && $awal == 0 && $tujuan == 0) {
            $query = "select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 group by noTransaksi";
        } elseif ($awal == 0 && $tujuan == 0) {
            $query = "select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=" . $idKasir . " group by noTransaksi";
        } else {
            $query = "select *,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 and idKasir=" . $idKasir . " and (tglTransaksi between '$awal' and '$tujuan') group by noTransaksi";
        }
        $koneksi->query($query);
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['nama'] . "</td>" .
                     "<td>" . $value['noTransaksi'] . "</td>" .
                     "<td>" . $value['tglTransaksi'] . "</td>" .
                     "<td>" . $value['SUM(jumlah)'] . "</td>" .
                     "<td>Rp." . number_format($value['SUM(totalBayar)'], 2, ",", ".") . "</td>" .
                     "</tr>";
            }
        }
        $koneksi->close_database();
    }

    public function tampilLaporan()
    {
        $koneksi = $this->connection();
        $koneksi->query("select nama,noTransaksi,tglTransaksi,SUM(jumlah),SUM(totalBayar) from penjualan join kasir using(idKasir) where noTransaksi!='' and penjualan.status=1 group by noTransaksi, nama, tglTransaksi");
        if ($koneksi->check_data()) {
            foreach ($koneksi->show_data() as $key => $value) {
                echo "<tr>" .
                     "<td>" . ($key + 1) . "</td>" .
                     "<td>" . $value['nama'] . "</td>" .
                     "<td>" . $value['noTransaksi'] . "</td>" .
                     "<td>" . $value['tglTransaksi'] . "</td>" .
                     "<td>" . $value['SUM(jumlah)'] . "</td>" .
                     "<td>Rp." . number_format($value['SUM(totalBayar)'], 2, ",", ".") . "</td>" .
                     "<td>
			<a href='cetak.php?action=cetaknota&noTransaksi=" . $value['noTransaksi'] . "'  target=\"_blank\"><button>Detail</button></a>
			</td>" .
                     "</tr>";
            }
        }
        $koneksi->close_database();
    }

    public function update()
    {
        $koneksi = $this->connection();
        $koneksi->query("update penjualan join buku using(idBuku) set jumlah=" . $this->jumlah . ", totalBayar=((buku.hargaJual*(jumlah+" . $this->jumlah . "))+((buku.hargaJual*(jumlah+" . $this->jumlah . "))*(buku.PPN/100))-((buku.hargaJual*(jumlah+" . $this->jumlah . "))*(diskon/100))) where idPenjualan='" . $this->idPenjualan . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di update'); window.location.replace('../distributor.php');</script>";
        }
        $koneksi->close_database();
    }

    public function delete()
    {
        $koneksi = $this->connection();
        $koneksi->query("delete from penjualan where idPenjualan='" . $this->idPenjualan . "'");
        if ( ! $koneksi->mysqli()->errno) {
            echo "<script>alert('Data berhasil di hapus'); window.location.replace('../penjualan.php');</script>";
        }
        $koneksi->close_database();
    }

    public function data($id)
    {
        $koneksi = $this->connection();
        $koneksi->query("select *, penjualan.status as statusBayar from penjualan join kasir using(idKasir) where noTransaksi='" . $id . "'");
        if ($koneksi->check_data()) {
            $data               = $koneksi->show_data()[0];
            $this->idPenjualan  = $data['idPenjualan'];
            $this->idBuku       = $data['idBuku'];
            $this->idKasir      = $data['idKasir'];
            $this->jumlah       = $data['jumlah'];
            $this->totalBayar   = $data['totalBayar'];
            $this->tglTransaksi = $data['tglTransaksi'];
            $this->status       = $data['statusBayar'];
            $this->namaKasir    = $data['nama'];
        }
        $koneksi->close_database();
    }
}
