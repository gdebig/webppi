<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class SidangModel extends Model{
    protected $table = 'tbl_jadwalsidang';
    protected $primaryKey = 'sidang_id';
    protected $allowedFields = ['sidang_id', 'ta_id', 'user_id', 'sidang_ruang', 'sidang_tanggal', 'sidang_judul', 'hasil_sidang', 'cat_sidang', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}