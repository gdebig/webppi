<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class TugasAkhirModel extends Model{
    protected $table = 'tbl_tugasakhir';
    protected $primaryKey = 'ta_id';
    protected $allowedFields = ['ta_id', 'user_id', 'ta_usuljudul', 'ta_semester', 'ta_tahun', 'startdate', 'enddate', 'instansi', 'divisi', 'ta_buku', 'ta_log', 'ta_bukurevisi', 'ta_penguji', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}