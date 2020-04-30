<?php
        include '../../dbcon/config.php';
        include '../../dbcon/connect.php';
       
        $curl = curl_init($products_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-type:application/json'
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
          $res = json_decode($response);
            $data = $res->data;

        $output='';

        foreach($data as $row) {
            $output .= '<div class="product-item" id="item_'.$row->pid.'" data-pid="'.$row->pid.'" data-pname="'.$row->pname.'" data-price="'.$row->price.'">
			<div>'.$row->pid.'</div>
			<img src="../products/'.$row->img.'" style="width:200px; border-radius: 105px;" alt="">
			<div>'.$row->pname.'</div>
            <div> Rs. '.$row->price.'/-</div>
        </div>';
        
        }
        echo $output;   
?>