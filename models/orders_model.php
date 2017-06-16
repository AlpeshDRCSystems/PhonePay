<?php

class Orders_model extends Dbmodel{
    private $tbl_orders='orders';
    function new_order($order_id,$amount){
        $sql="INSERT INTO $this->tbl_orders (`timestamp`,`order_id`,`amount`,`status`) VALUES (?,?,?,'unpaid')";
		$stmt=$this->mysqli->prepare($sql);
		$stmt->bind_param('sss',$time,$order_id,$amount);
		$stmt->execute();
                if($stmt->error){
                    echo $stmt->error;
                }
                $id=$this->mysqli->insert_id;
		$stmt->close();
                return $id;
    }
    
    function order_id_exist($order_id){
        $query="SELECT `id` FROM `$this->tbl_orders` WHERE `order_id`= ?";
		$stmt=$this->mysqli->prepare($query);
		$stmt->bind_param('s',$order_id);
		$stmt->execute();
		$stmt->bind_result($id);
		while($stmt->fetch()){
		return $id;
    }
    
    
    function total_orders(){
        $sql="SELECT COUNT(id) FROM $this->tbl_orders";
		$stmt=$this->mysqli->prepare($sql);
		$stmt->execute();
                if($stmt->error){
                    echo $stmt->error;
                }
                $stmt->bind_result($count);
		while($stmt->fetch()){
			$row=$count;
                       }
                return $row;
    } 
    
    function list_orders($start,$limit,$orderby,$orderval,$keyword){
                        $result[$n]['order_id']=$order_id;
		echo $stmt->error;
    function orders_bydate($from,$to){
    
  function update_order_data($id,$phone,$amount,$status){
        $query="UPDATE $this->tbl_orders SET `phone`=?,`amount`=?,`status`=? WHERE `id`=?";
		$stmt=$this->mysqli->prepare($query);
                $error=$this->mysqli->error;
                if($error){
                    return $error;
                    exit();
                }
		$stmt->bind_param('sssi',$phone,$amount,$status,$id);
		$stmt->execute();
                echo $stmt->error;
		$stmt->close();
        
    }
    
    function delete_order($id){
        $sql="DELETE FROM $this->tbl_orders WHERE id=?";
		$stmt=$this->mysqli->prepare($sql);
                $stmt->bind_param('i', $id);
		$stmt->execute();
                if($stmt->error){
                    echo $stmt->error;
                }
                return true;
    }
    

   function create_phone_order($data){
       if(empty($data['order_id'])){ $data['order_id']='';}
       $sql="INSERT INTO $this->tbl_orders (`timestamp`,`order_id`,`phone`,`amount`,`status`) VALUES (?,?,?,?,'unpaid')";
		$stmt=$this->mysqli->prepare($sql);
		$stmt->bind_param('ssss',$time,$data['order_id'],$data['phone'],$data['amount']);
		$stmt->execute();
                if($stmt->error){
                    echo $stmt->error;
                }
                $id=$this->mysqli->insert_id;
		$stmt->close();
                return $id;
   } 
    
    
//end of class    
}