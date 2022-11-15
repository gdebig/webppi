<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class NilaitaModel extends Model{
    protected $table = 'tbl_nilaita';
    protected $primaryKey = 'nilaita_id';
    protected $allowedFields = ['nilaita_id', 'ta_id', 'dosen_id', 'mhs_id', 'tipedosen', 'penulisan', 'presentasi', 'materi', 'signed', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}