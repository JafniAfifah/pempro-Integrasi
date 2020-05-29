<?php

class page_controller
{
    public $dao_mkn;

    public function __construct()
    {
        $this->dao_mkn = new dao_mkn();
    }

    public function invoke()
    {

        $result = $this->dao_mkn->select();
        if (isset($_SERVER['HTTP_ACCEPT'])) {
            $type = $_SERVER['HTTP_ACCEPT'];
            if (strpos($type, 'text/html') !== false) {
                if ((!isset($_GET['nama'])) && (!isset($_GET['deskripsi'])) && (!isset($_GET['simpan']))) {
                    include 'view/input.php';
                } else {
                    $hasil = $this->dao_mkn->simpan($_GET['nama'], $_GET['deskripsi']);
                    $result = $this->dao_mkn->select();
                    include 'view/cetak.php';
                }
            }
        }

        if (isset($_SERVER['CONTENT_TYPE'])) {
            $type1 = $_SERVER['CONTENT_TYPE'];
            if (strpos($type1, 'application/json') !== false) {
                if ((!isset($_POST['nama'])) && (!isset($_POST['deskripsi'])) && (!isset($_POST['simpan']))) {
                    header('Content-Type: application/json');
                    echo json_encode($result);
                }
            }
            if (strpos($type1, 'application/x-www-form-urlencoded') !== false) {
                if ((isset($_POST['id'])) && (isset($_POST['nama'])) && (isset($_POST['deskripsi']))) {
                    //update
                    $hasil = $this->dao_mkn->update($_POST['id'], $_POST['nama'], $_POST['deskripsi']);
                    if ($hasil == 1) {
                        header('Content-Type: application/json');
                        echo json_encode('status update:berhasil');
                    }
                } elseif ((isset($_POST['nama'])) && (isset($_POST['deskripsi']))) {
                    //insert
                    $hasil = $this->dao_mkn->simpan($_POST['nama'], $_POST['deskripsi']);
                    if ($hasil == 1) {
                        header('Content-Type: application/json');
                        echo json_encode('status simpan:berhasil');
                    }
                } elseif ((isset($_POST['id']))) {
                    //delete
                    $hasil = $this->dao_mkn->delete($_POST['id']);
                    if ($hasil == 1) {
                        header('Content-Type: application/json');
                        echo json_encode('status delete:berhasil');
                    }
                }
            }
        }
    }
}
