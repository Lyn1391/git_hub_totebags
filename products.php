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
            
                        <ul style='float:left; margin:10px 0;list-style-type:none;'>
                            <li data-sku-img='$sku'><img src='data:image/jpeg;base64,$img',width='250px' height='250px' /></li>
                        </ul>
            
                        <ul style='float:left; margin:10px 0;list-style-type:none;'>
                            
                            <span>$<span data-sku-price='$sku'>$price</span></span>
                            <li><input data-sku-qty='$sku' type='number' value='1' min='1' max='10' step='1' />
                            <input data-sku-add='$sku' type='button' value='Add'/></li>
                       
                        </ul>
                        
                    
                      
                      ";
        }
        echo $html;
        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET allowed.");

    }

    echo json_encode($data, JSON_FORCE_OBJECT);

?>
