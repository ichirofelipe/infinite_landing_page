<?php

    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        
        if(file_exists($filePath)){
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        
        return $output;
    }

    function generate_jwt($headers, $payload, $secret = 'iloveFamily') {
        $headers_encoded = base64url_encode(json_encode($headers));
        
        $payload_encoded = base64url_encode(json_encode($payload));
        
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = base64url_encode($signature);
        
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        
        return $jwt;
    }

    function is_jwt_valid($jwt, $secret = 'iloveFamily') {
        // split the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
        $expiration = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;

        // build a signature based on the header and payload using the secret
        $base64_url_header = base64url_encode($header);
        $base64_url_payload = base64url_encode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = base64url_encode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);
        
        if ($is_token_expired || !$is_signature_valid) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function get_authorization_header(){
        $headers = null;
        
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        
        return $headers;
    }

    function get_bearer_token() {
        $headers = get_authorization_header();
        
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    function logInfo($log){
        //Write action to txt log
        file_put_contents('../logs/error_logs_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
    }
    
    function dd($var){
        var_dump($var);
        die();
    }

    function validateRequests($requests, $rules, $encrypt = false){
        $data['errors'] = [];
        
        foreach($rules as $fillable => $rule){
            $rules_arr = explode(',', $rule);
            $data[$fillable] = clean_input($requests[$fillable]);
    
            foreach($rules_arr as $rule){
                switch($rule){
                    case 'required':
                        if(empty($data[$fillable]))
                            array_push($data['errors'], $fillable.' is required');
                        break;
                    default:
                        if(count(explode(':', $rule)) != 2)
                            break;
    
                        $newrule = explode(':', $rule);
    
                        if(strlen($data[$fillable]) > $newrule[1] && $newrule[0] == 'max')
                            array_push($data['errors'], $fillable.' must not be more than '.$newrule[1].' characters');
    
                        if(strlen($data[$fillable]) < $newrule[1] && $newrule[0] == 'min')
                            array_push($data['errors'], $fillable.' must not be less than '.$newrule[1].' characters');
                            
                        if($newrule[0] == 'unique' && !empty($data[$fillable]) && userExistsQuery($data[$fillable], $newrule[1]))
                            array_push($data['errors'], $fillable.' is already in use.');
    
                        break;
                }
            }
    
            if($fillable == 'password' && $encrypt)
                $data[$fillable] = password_hash($data[$fillable], PASSWORD_BCRYPT);
        }
    
        return $data;
    }
    
    function generateToken($id, $name = "_token", $exp = 86400){
        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $payload = array('id'=>$id, 'exp' => time() + $exp);
    
        $jwt = generate_jwt($headers, $payload);
    
        setcookie($name, $jwt, time() + $exp, '/');
    }
    
    
    function clean_input($data) {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
    
        return $data;
    }

    function getColumns($data){
        $tmpData = [];
    
        foreach($data as $key => $value){
            array_push($tmpData, $key);
        }
    
        return $tmpData;
    }
    
    function paginate($totalPosts, $currentPage = 1, $perPage = 9, $pageToDisplay = 5){
        //DECLARE VARIABLES
        $pagination['start'] = $pagination['end'] = $pagination['limit'] = null;
    
        $tmp = $currentPage % $pageToDisplay;
        
        //GET MAX PAGES
        $pagination['limit'] = ceil($totalPosts / $perPage);
    
        //GET PAGINATION START AND END
        $pagination['start'] = $currentPage - ($pageToDisplay - 1);
        $pagination['end'] = (int)$currentPage;
        if($tmp != 0){
            $pagination['start'] = $currentPage - ($tmp - 1);
            $pagination['end'] = $currentPage + ($pageToDisplay - $tmp);
        }
        if($pagination['end'] > $pagination['limit'])
            $pagination['end'] = $pagination['limit'];
    
        if($pagination['limit'] < 2)
            return null;
        
        return $pagination;
    }

?>