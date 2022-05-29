<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CapesOrgModel extends Model{
    protected $table = 'tbl_organisasi';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Name', 'Type', 'City', 'Country', 'Period', 'StartPeriodBulan', 'StartPeriodYear', 'EndPeriodBulan', 'EndPeriodYear', 'Position', 'OrgLevel', 'OrgScp', 'Desc', 'File', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}