<?php

require_once('init2.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isPOST()) {
        // post means either to delete or add a user
        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');
        $user_name = $parameters->getValue('username');

        //$data = array("action" => $action, "user_name" => $user_name);
        if($action == 'delete' && !empty($user_name)) {

            $um = new UserManager();
            $um->deleteUser($user_name);
            $data = array("status" => "success", "msg" => "User '$user_name' deleted.");
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'update' && !empty($user_name)) {
            $newFirstName = $parameters->getValue('newFirstName');
            $newLastName = $parameters->getValue('newLastName');
            $newUserName = $parameters->getValue('newUserName');
            $newQuantity = $parameters->getValue('newQuantity');

            if(!empty($newFirstName)) {

                $um = new UserManager();
                $count = $um->updateUserFirstName($user_name, $newFirstName);
                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' updated with new first name ('$newFirstName').");
                } else {
                    $data = array("status" => "fail", "msg" =>
                        "User '$user_name' was NOT updated with new first name ('$newFirstName').");
                }
            } 
            
            if(!empty($newLastName)) {

                $um = new UserManager();
                $count = $um->updateUserLastName($user_name, $newLastName);
                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' updated with new last name ('$newLastName').");
                } else {
                    $data = array("status" => "fail", "msg" =>
                        "User '$user_name' was NOT updated with new last name ('$newLastName').");
                }
            }
            
            if(!empty($newUserName)) {

                $um = new UserManager();
                $count = $um->updateUserUserName($user_name, $newUserName);
                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' updated with new user name ('$newUserName').");
                } else {
                    $data = array("status" => "fail", "msg" =>
                        "User '$user_name' was NOT updated with new user name ('$newUserName').");
                }
            }
            
            if(!empty($newQuantity)) {

                $um = new UserManager();
                $count = $um->updateUserQuantity($user_name, $newQuantity);
                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' updated with new user name ('$newQuantity').");
                } else {
                    $data = array("status" => "fail", "msg" =>
                        "User '$user_name' was NOT updated with new user name ('$newQuantity').");
                }
            }
            
            else {
                $data = array("status" => "fail", "msg" =>
                    "New user name must be present - value was '$newFirstName' for '$user_name'.");

            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'add') {
            $newFirstName = $parameters->getValue('newFirstName');
            $newLastName = $parameters->getValue('newLastName');
            $newUserName = $parameters->getValue('newUserName');
            $newImage = $parameters->getValue('newImage');
            $newQuantity = $parameters->getValue('newQuantity');

            if(!empty($newFirstName) && !empty($newLastName) && !empty($newUserName) && !empty($newImage)) {
                $data = array("status" => "success", "msg" => "User added.");
                $um = new UserManager();
                $um->addUser($newFirstName, $newLastName, $newUserName, $newImage, $newQuantity);

            } else {
                $data = array("status" => "fail", "msg" => "First name, last name, and user name cannot be empty.");
            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        }else {
            $data = array("status" => "fail", "msg" => "Action not understood.");
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
        return;

    } else if(Utils::isGET()) {
        // get means get the list of users
        $um = new UserManager();
        $rows = $um->listUsers();
        $html = "";
        if($rows != null) {

            foreach($rows as $row) {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $user_name = $row['user_name'];
                $i_image = $row['image'];
                $quan_tity = $row['quantity'];

                $html .= "<tr>
                  <td class='first_name'><span>$first_name</span></td>
                  <td class='last_name'>$<span></span><span>$last_name</span></td>
                  <td class='user_name'><span>$user_name</span></td>
                  <td class='i_image'><span><img src='$i_image' style='width:80px; height:80px;'/></span></td>
                  <td class='quantity'><span>$quan_tity</span></td>
                  <td><input id='d-$user_name' class='delete btn btn-brown' type='button' value='Delete'/></td>
                  <td><input id='u-$user_name' class='update btn btn-brown' type='button' value='Update'/></td>
                  
                  </tr>";
            }
            echo $html;

        } else {
            // shouldn't be but ...
            echo 'The returned rows is "null". No user table perhaps?';
        }

        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET and POST allowed.");
        echo json_encode($data, JSON_FORCE_OBJECT);
    }



?>
