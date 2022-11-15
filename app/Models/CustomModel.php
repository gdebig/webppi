<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class CustomModel{
    protected $db;

    public function __construct(ConnectionInterface &$db){
        $this->db =& $db;
    }

    function getBimbing($id){
        $builder = $this->db->table('tbl_bimbing');
        $builder->join('tbl_profile', 'tbl_bimbing.mhs_id = tbl_profile.user_id', 'left');
        $builder->join('tbl_tugasakhir', 'tbl_bimbing.mhs_id = tbl_tugasakhir.user_id', 'left');
        $builder->join('tbl_nilaita', 'tbl_bimbing.mhs_id = tbl_nilaita');
        $builder->orderby('tbl_profile.FullName', 'ASC');
        $builder->where('tbl_bimbing.dosen_id', $id);
        $posts = $builder->get()->getResult();
        return $posts;
    }
}
?>