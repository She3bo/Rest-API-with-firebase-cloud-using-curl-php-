<?php
class ApiFunctions{

    private $url = "https://storagecloudassignment.firebaseio.com/users";

    public function get(){
        $curl = curl_init($this->url.".json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,'Content-Type: application/json');
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        return $response;
    } 
    public function post($data){
        $curl = curl_init($this->url.".json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER,'Content-Type: application/json');
        $response = curl_exec($curl);
        curl_close($curl);
        header("Location:index.php");
    }
    public function delete($id){
        $curl = curl_init($this->url."/".$id.".json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_HTTPHEADER,'Content-Type: application/json');
        $response = curl_exec($curl);
        curl_close($curl);
        return header("Location:index.php");
    }


}

$obj = new ApiFunctions();

if(isset($_POST['submit'])){
    //echo "submit";
    $data = array("name"  => $_POST['name'],
                  "age"   => $_POST['age'],
                  "email" => $_POST['email']);
    var_dump(json_encode($data));
    $obj->post($data);
}
if(isset($_POST['delete'])){
    $url_components = parse_url($_SERVER['REQUEST_URI']); 
    parse_str($url_components['query'], $params);
    $obj->delete($params['delete']);
}