<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CapesKartulModel extends Model{
    protected $table = 'tbl_karyatulis';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Name', 'Media', 'LocCity', 'LocProv', 'LocCountry', 'Year', 'Month', 'Mediatype', 'Diffbenefit', 'Desc', 'File', 'kompetensi', 'nilai_p', 'nilai_q', 'nilai_r', 'nilai_w1', 'nilai_w2', 'nilai_w3', 'nilai_w4', 'nilai_pil', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}