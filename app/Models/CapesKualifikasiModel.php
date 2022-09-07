<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CapesKualifikasiModel extends Model{
    protected $table = 'tbl_kualifikasi';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'StartDate', 'EndDate', 'NameInstance', 'Position', 'Name', 'Giver', 'LocCity', 'LocProv', 'LocCountry', 'Duration', 'Jabatan', 'ProjValue', 'RspnValue', 'Hresource', 'Diff', 'Scale', 'Desc', 'File', 'kompetensi', 'nilai_p', 'nilai_q', 'nilai_r', 'nilai_w1', 'nilai_w2', 'nilai_w3', 'nilai_w4', 'nilai_pil', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}