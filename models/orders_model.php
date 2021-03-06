<?php

class Orders_model extends Dbmodel{
    private $tbl_orders='orders';
    function new_order($order_id,$amount){		$time=time();
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
		while($stmt->fetch()){			$id=$id;		}
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
    } 		function total_orders_status($status){        $sql="SELECT COUNT(id) FROM $this->tbl_orders WHERE status=?";				$stmt=$this->mysqli->prepare($sql);		$stmt->bind_param('s',$status);		$stmt->execute();                if($stmt->error){                    echo $stmt->error;                }                $stmt->bind_result($count);		while($stmt->fetch()){			$row=$count;                       }                return $row;    } 
    			
    function list_orders($start,$limit,$orderby,$orderval,$keyword){        $columns=array('id','timestamp','order_id','id','amount','overage','refunded','status');                $order=$columns[$orderby];                $result=array();				if($orderval=="asc"){					$orderval="desc";				}else{					$orderval="asc";				}                if($keyword){                   $search='%'.$keyword.'%';                   $qu="SELECT id,timestamp,order_id,phone,amount,overage,refunded,status FROM $this->tbl_orders WHERE phone LIKE ? OR order_id LIKE ? ORDER BY id LIMIT ? , ? ";                   $stmt=$this->mysqli->prepare($qu);                   $stmt->bind_param('ssii',$search,$search,$start,$limit);                }  elseif(!$keyword) {                    $qu="SELECT id,timestamp,order_id,phone,amount,overage,refunded,status FROM $this->tbl_orders ORDER BY $order $orderval LIMIT ? , ? ";                    $stmt=$this->mysqli->prepare($qu);                    $stmt->bind_param('ii',$start,$limit);                }                $stmt->execute();                echo $stmt->error;		$stmt->bind_result($id,$timestamp,$order_id,$phone,$amount,$overage,$refunded,$status);		$n=0;                while($stmt->fetch()){						$result[$n]['id']=$id;						$result[$n]['timestamp']=$timestamp;
                        $result[$n]['order_id']=$order_id;                        $result[$n]['phone']=$phone;                        $result[$n]['amount']=$amount;                        $result[$n]['overage']=$overage;                        $result[$n]['refunded']=$refunded;                        $result[$n]['status']=$status;                        $n++;			}
		echo $stmt->error;		$stmt->close();		return $result;    }
    function orders_bydate($from,$to){		$qu="SELECT id,timestamp,order_id,phone,amount,status FROM $this->tbl_orders WHERE timestamp >= ? AND timestamp<= ? ORDER BY id DESC";        $stmt=$this->mysqli->prepare($qu);        $stmt->bind_param('ss',$from,$to);        $stmt->execute();        echo $stmt->error;		$stmt->bind_result($id,$timestamp,$order_id,$phone,$amount,$status);		$n=0;                while($stmt->fetch()){						$result[$n]['id']=$id;						$result[$n]['timestamp']=$timestamp;                        $result[$n]['order_id']=$order_id;                        $result[$n]['phone']=$phone;                        $result[$n]['amount']=$amount;                        $result[$n]['status']=$status;                        $n++;			}		echo $stmt->error;		$stmt->close();		return $result;			}			function get_order($id){		$sql="SELECT id,order_id,phone,amount,status FROM $this->tbl_orders WHERE id=?";		$stmt=$this->mysqli->prepare($sql);                $stmt->bind_param('i', $id);		$stmt->execute();                if($stmt->error){                    echo $stmt->error;                }        $stmt->bind_result($id,$order_id,$phone,$amount,$status);		while($stmt->fetch()){				$result['id']=$id;                $result['first_name']=$first_name;                $result['order_id']=$order_id;                $result['phone']=$phone;                $result['amount']=$amount;                $result['status']=$status;                }		echo $stmt->error;		$stmt->close();		return $result;	}
    
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
    

   function create_phone_order($data){		$time=time();
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
