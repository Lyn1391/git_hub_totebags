<?php

require_once('init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isGET()) {
        $pm = new ProductManager();
        $rows = $pm->listProducts();

        $html = "";
        foreach($rows as $row) {
            $sku = $row['user_name'];
            $price = $row['last_name'];
            $desc = $row['first_name'];
            $img = $row['image'];
            
            // <img src="data:image/jpeg;base64,' . base64_encode($row2['image']) . '" width="290" height="290">'
            $html .= "
            
            
                  <div class='col-xs-12 contentleft'>
                    </br>
                            <img class='imagestyle' data-sku-img='$sku' src='$img' style='width:80%; height:150px;'/></br>
                            
                            <input data-sku-qty='$sku' class='image' type='number' value='1' min='1' max='10' size='5'/></br></br>

                            <span data-sku-price='$sku' class=''>$desc</span></br></br>
                            
                            <span data-sku-price='$sku' class='price'>$price</span></br></br>
                            
                            <input  class='addcart cart2' data-sku-add='$sku' type='button' value='Add to cart'/>
                       
                  </div>
              
              
                      ";
        }
        echo $html;
        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET allowed.");

    }

    echo json_encode($data, JSON_FORCE_OBJECT);

?>
