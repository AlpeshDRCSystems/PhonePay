<?php
class Orders extends Controller{
    function index(){}
    
    function new_order(){
        $response['status']=FALSE;
        $order_id=  user_in_filter($_POST['order_id']);
        $amount=  user_in_filter($_POST['amount']);
        if($order_id && $amount){
            $this->loadModel('orders_model');
            $orders_model=new Orders_model();
            if($orders_model->order_id_exist($order_id)){
                 $response['message']='Duplicate Order ID';
            }  else {
                $orders_model->new_order($order_id, $amount);
                $response['status']=TRUE;
                $response['message']='Order created';
            }
        }  else {
            $response['message']='Fill all required fields';
        }
        echo json_encode($response);
    }
    
    
    
    function view_orders(){
        $this->loadModel('orders_model');
        $om=new Orders_model();
        $draw=user_in_filter($_REQUEST['draw']);
        $start=user_in_filter($_REQUEST['start']);
        $length=user_in_filter($_REQUEST['length']);
        $search=user_in_filter($_REQUEST['search']['value']);
        $orderby=  user_in_filter($_REQUEST['order'][0]['column']);
        $orderval=  user_in_filter($_REQUEST['order'][0]['dir']);
        $count=$om->total_orders();
        $contact_list=$om->list_orders($start,$length,$orderby,$orderval,$search);
        $data['draw']=$draw;
        $data['recordsTotal']=$count;
        $data['recordsFiltered']=$count;
        $n=0;
        if(!$contact_list){
            $data['sEcho']=0;
        }
        foreach ($contact_list as $value) {
            $phone="Nil";
            $order_id="Nil";
            if($value['phone']!=0){ $phone=$value['phone'];}
            if($value['order_id']){ $order_id=$value['order_id'];}
            
        }
        echo json_encode($data);
    }
    
    
    function update_order(){
        $response['status']=FALSE;
        $id=  user_in_filter($_POST['id']);
        $amount=  user_in_filter($_POST['amount']);
        $phone=user_in_filter($_POST['phone']);
        $status=user_in_filter($_POST['status']);
        $this->loadModel('orders_model');
        $om=new Orders_model();
        $om->update_order_data($id, $phone, $amount, $status);
        $response['status']=TRUE;
        $response['message']="Order Updated.";
        echo json_encode($response);
    }
    
    function delete_order(){
        $id=  user_in_filter($_POST['id']);
        $this->loadModel('orders_model');
        $om=new Orders_model();
        $om->delete_order($id);
        $response['status']=TRUE;
        $response['message']="Order Deleted.";
        echo json_encode($response);
    }
//end of class    
}