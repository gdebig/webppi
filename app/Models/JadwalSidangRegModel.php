<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class JadwalSidangRegModel extends Model{
    protected $table = 'tbl_jadwalsidangreg';
    protected $primaryKey = 'sidangr_id';
    protected $allowedFields = ['sidangr_id', 'tar_id', 'user_id', 'sidang_ruang', 'sidang_tanggal', 'sidang_judul', 'hasil_sidang', 'cat_sidang', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}