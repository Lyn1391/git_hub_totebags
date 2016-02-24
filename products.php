<?php

require_once('init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isGET()) {
        $pm = new ProductManager();
        $rows = $pm->listProducts();

        $html = "";
        foreach($rows as $row) {
            $sku = $row['SKU'];
            $price = $row['item_price'];
            $desc = $row['description'];
            $img = base64_encode($row['image']);
            
            // <img src="data:image/jpeg;base64,' . base64_encode($row2['image']) . '" width="290" height="290">'
            $html .= "
            <div id='menu-outer'>
                <div id='horizontal-list'>
                  <ul>
                  <li class='alignlist'>
                    
                            <input data-sku-qty='$sku' class='image' type='number' value='1' min='1' max='10' size='5'/>
                            <span data-sku-price='$sku' class='price'>$price</span></br>
                            <img class='imagestyle' data-sku-img='$sku' src='data:image/jpeg;base64,$img'/></br>
                            <input  class='addcart btn btn-info btn-lg' data-sku-add='$sku' type='button' value='Add to cart'/>
                       
                    </li>
                   </ul>
                </div>
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
