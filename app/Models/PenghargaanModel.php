<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class PenghargaanModel extends Model{
    protected $table = 'tbl_penghargaan';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Year', 'Month', 'Name', 'Institute', 'City', 'Prov', 'Country', 'Level', 'InstituteType', 'Desc', 'File', 'kompetensi', 'nilai_p', 'nilai_q', 'nilai_r', 'nilai_w1', 'nilai_w2', 'nilai_w3', 'nilai_w4', 'nilai_pil', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}