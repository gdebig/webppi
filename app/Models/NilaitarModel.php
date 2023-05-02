<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class NilaitarModel extends Model{
    protected $table = 'tbl_nilaitar';
    protected $primaryKey = 'nilaitar_id';
    protected $allowedFields = ['nilaitar_id', 'tar_id', 'dosen_id', 'mhs_id', 'tipedosen', 'penulisan', 'presentasi', 'materi', 'signed', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}