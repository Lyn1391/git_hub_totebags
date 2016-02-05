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
            $html .= "<tr>
                        <td><input data-sku-qty='$sku' type='number' value='1' min='1' max='10' step='1'/></td>
                        <td data-sku-price='$sku'>$price</td>
                        <td data-sku-img='$sku'><img src='data:image/jpeg;base64,$img'/></td>
                        
                        <td><input data-sku-add='$sku' type='button' value='Add'/></td>
                      </tr>";
        }
        echo $html;
        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET allowed.");

    }

    echo json_encode($data, JSON_FORCE_OBJECT);

?>
