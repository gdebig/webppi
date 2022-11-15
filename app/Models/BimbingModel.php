<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class BimbingModel extends Model{
    protected $table = 'tbl_bimbing';
    protected $primaryKey = 'bimbing_id';
    protected $allowedFields = ['bimbing_id', 'mhs_id', 'dosen_id', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';

    public function getDataBimbing($id){
        return $this->db->table('tbl_bimbing')->join('tbl_profile', 'tbl_bimbing.mhs_id = tbl_profile.user_id', 'left')->join('tbl_tugasakhir', 'tbl_bimbing.mhs_id = tbl_tugasakhir.user_id', 'left')->join('tbl_nilaita', 'tbl_bimbing.mhs_id = tbl_nilaita.mhs_id', 'left')->where('tbl_bimbing.dosen_id', $id)->get()->getResultArray();
    }
}