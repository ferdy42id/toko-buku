<?php
/**
 * @author Ferdy Sopian
 */

namespace APP;

require_once 'AbstractQuery.php';

/**
 * Class Hotel
 * @package APP
 */
class Hotel extends AbstractQuery {
	public $id;
	public $namaHotel;
	public $namaManager;
	public $alamat;
	public $telepon;
	public $jumlahKamar;
	public $tanggalOprasi;

	/**
	 * Hotel constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @inheritDoc
	 */
	public function select() {
		$koneksi = $this->connection();
		$koneksi->query( 'select * from hotel' );
		if ( $koneksi->check_data() ) {
			foreach ( $koneksi->show_data() as $key => $value ) {
				echo "<tr>" .
				     "<td>" . ( $key + 1 ) . "</td>" .
				     "<td>" . $value['namaHotel'] . "</td>" .
				     "<td>" . $value['namaManager'] . "</td>" .
				     "<td>" . $value['alamat'] . "</td>" .
				     "<td>" . $value['telepon'] . "</td>" .
				     "<td>" . $value['jumlahKamar'] . "</td>" .
				     "<td>" . $value['tanggalOprasi'] . "</td>";
				echo "<td>
                <a href='hotel.php?id=" . $value['idHotel'] . "&action=edit'><button>EDIT</button></a>
                <a href='proses/proses-hapus.php?id=" . $value['idHotel'] . "&type=6'><button>HAPUS</button></a>
                </td>" .
				     "</tr>";
			}
		}
		$koneksi->close_database();
	}

	/**
	 * @inheritDoc
	 */
	public function update() {
		$koneksi = $this->connection();
		$koneksi->query( "update hotel set namaHotel='" . $this->namaHotel . "', namaManager='" . $this->namaManager . "',alamat='" . $this->alamat . "',jumlahKamar='" . $this->jumlahKamar . "',tanggalOprasi='" . $this->tanggalOprasi . "' where idHotel='" . $this->id . "'" );
		if ( ! $koneksi->mysqli()->errno ) {
			echo "<script>alert('Data berhasil di update'); window.location.replace('../hotel.php');</script>";
		}
		$koneksi->close_database();
	}

	/**
	 * @inheritDoc
	 */
	public function delete() {
		$koneksi = $this->connection();
		$koneksi->query( "delete from hotel where idHotel='" . $this->id . "'" );
		if ( ! $koneksi->mysqli()->errno ) {
			echo "<script>alert('Data berhasil di hapus'); window.location.replace('../hotel.php');</script>";
		}
		$koneksi->close_database();
	}

	/**
	 * @param $id
	 *
	 * @inheritDoc
	 */
	public function data( $id ) {
		$koneksi = $this->connection();
		$koneksi->query( "select * from hotel where idHotel=" . $id );
		if ( $koneksi->check_data() ) {
			$data                = $koneksi->show_data()[0];
			$this->id            = $data['idHotel'];
			$this->namaHotel     = $data['namaHotel'];
			$this->namaManager   = $data['namaManager'];
			$this->alamat        = $data['alamat'];
			$this->telepon       = $data['telepon'];
			$this->jumlahKamar   = $data['jumlahKamar'];
			$this->tanggalOprasi = $data['tanggalOprasi'];
		}
		$koneksi->close_database();
	}

	/**
	 * @inheritDoc
	 */
	public function insert() {
		$koneksi = $this->connection();
		$koneksi->query( "insert into hotel(namaHotel,namaManager,alamat,telepon,jumlahKamar,tanggalOprasi) values('" . $this->namaHotel . "', '" . $this->namaManager . "','" . $this->alamat . "','" . $this->telepon . "','" . $this->jumlahKamar . "','" . $this->tanggalOprasi . "')" );
		if ( ! $koneksi->mysqli()->errno ) {
			echo "<script>alert('Data berhasil di tambahkan'); window.location.replace('../hotel.php');</script>";
		} else {
			echo "<script>alert('Data gagal di tambahkan'); window.location.replace('../hotel.php');</script>";
		}
		$koneksi->close_database();
	}
}
