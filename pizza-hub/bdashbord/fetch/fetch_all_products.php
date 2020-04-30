<?php
        include '../../dbcon/connect.php';
        $sql = "select * from products";
        $result = mysqli_query($con,$sql);
        if(!$result) {
            echo "Error: ".mysqli_erro($con);
        }

        $output='';

        while($row = mysqli_fetch_assoc($result)) {
            $output .= '<div class="product-item" id="item_'.$row['pid'].'" data-pid="'.$row['pid'].'" data-pname="'.$row['pname'].'" data-price="'.$row['price'].'">
			<div>'.$row['pid'].'</div>
			<img src="../products/'.$row['img'].'" style="width:200px; border-radius: 105px;" alt="">
			<div>'.$row['pname'].'</div>
            <div> Rs. '.$row['price'].'/-</div>
        </div>';
        
        }
        echo $output;   
?>