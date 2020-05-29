<?php
class dao_mkn
{

    private $db;

    public function __construct()
    {
        $this->db = new db(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    // select database
    public function select()
    {
        $sql = "select * from makanan";
        $hasil = $this->db->proses($sql);
        $result = array();
        while ($baris = mysqli_fetch_array($hasil)) {
            $kat = new mkn();
            $kat->set_id($baris['id_makanan']);
            $kat->set_nama($baris['nama_makanan']);
            $kat->set_desc($baris['deskripsi']);
            $result[] = $kat;
        }
        return $result;
    }

    // insert database
    public function simpan($nama, $desc)
    {
        $sql = "INSERT into makanan(nama_makanan,deskripsi) values('" . $nama . "','" . $desc . "')";
        $hasil = $this->db->proses($sql);
        return $hasil;
    }

    // delete 
    public function delete($id)
    {
        $sql = "DELETE from makanan where id_makanan= '" . $id . "'";
        $hasil = $this->db->proses($sql);
        return $hasil;
    }

    // update
    public function update($id, $nama, $desc)
    {
        $sql = "UPDATE makanan
        SET nama_makanan = '" . $nama . "', deskripsi = '" . $desc . "'
        WHERE id_makanan = '" . $id . "';";
        $hasil = $this->db->proses($sql);
        return $hasil;
    }
}
