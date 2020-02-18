<?php

class Relations_model extends CI_Model {

    function insertRelations($data){
        if(count($data) <= 1){
            return 0;
        }
        foreach($data as $item){
            foreach($data as $subItem){
                $success = 0;
                if($subItem != $item){
                    $arr = array('ar_parent_type' => $item->type,
                        'ar_parent_id' => $item->id,
                        'ar_child_type' => $subItem->type,
                        'ar_child_id' => $subItem->id 
                    );
                    $this->db->insert('ar_relations',$arr);
                    $ID = $this->db->insert_id();
                    if(is_int($ID)){
                        $success++;
                    }
                }
            }
        }
        return $success;
    }
    
    function getRelations($type,$value){
        $this->db->where('ar_parent_type',$type); 
        $this->db->where('ar_parent_id',$value);
        $relationQ = $this->db->get('ar_relations');
        return $relationQ->result();
    }
    
    function getFilteredItems($data){
        $out = array();
        foreach($data as $filter){
            $items = $this->getItems($filter);
            array_push($out, $items);
        }
        return $out;
    }
    
    function getItems($filter){
        $relations = $this->getRelations($filter->filterType, $filter->filterValue);
        $out = array();
        $items = array();
        $filters = array();
        foreach($relations as $relation){
            $this->db->where('type_ID',$relation->ar_child_type);
            $typeQ = $this->db->get('ar_types');
            $type = $typeQ->row();
            $this->db->where($type->table . '_ID', $relation->ar_child_id);
            $query = $this->db->get('ar_' . $type->table);
            $result = $query->row();
            if(isset($result->img_url)){
                array_push($items,$result);
            }else{
                array_push($filters, $result);
            }
        }
        $out['items'] = $items;
        $out['filters'] = $filters;
        return $out;
    }
}
