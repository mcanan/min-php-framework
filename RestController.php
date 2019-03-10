<?php
namespace mcanan\framework;

abstract class RestController extends Controller 
{
    private $request_method;

    protected $bad_data = 400;
    protected $unauthorized = 401;
    protected $success = 200;
    protected $secured = true;

    protected $token = "";
    protected $secret = "";

    abstract protected function delete($parms);
    abstract protected function put($parms);
    abstract protected function post($parms);
    abstract protected function get($parms);
    abstract protected function set_secret();

    function __construct()
    {
        parent::__construct();
        
        $this->request_method = $_SERVER['REQUEST_METHOD'];
    }

    private function get_request_body()
    {
        $input = file_get_contents('php://input');
        parse_str($input, $request);
        return $request;
    }

    protected function is_authorized()
    {
        if (isset($_SERVER['HTTP_X_AUTH_TOKEN']) &&
            isset($_SERVER['HTTP_X_AUTH_SIGNATURE']) &&
            isset($_SERVER['HTTP_X_AUTH_TIMESTAMP'])){

            $this->token = $_SERVER['HTTP_X_AUTH_TOKEN'];
            $signature = $_SERVER['HTTP_X_AUTH_SIGNATURE'];
            $timestamp = $_SERVER['HTTP_X_AUTH_TIMESTAMP'];
            $result = $this->set_secret();
            $sig = hash_hmac('SHA256', $timestamp, $this->secret);

            return ($signature==$sig);
        } else {
            return false;
        }
    }

    protected function process_request()
    {
        header('Content-Type: application/json');
        if (!$this->secured || $this->is_authorized()){
            switch ($this->request_method) {
            case 'DELETE':
                $parms = $this->get_request_body();
                $result = $this->delete($parms);
                if (!$result){
                    http_response_code($this->bad_data);
                } else {
                    http_response_code($this->success);
                }
                break;
            case 'POST':
                $result = $this->post($_POST);
                if (!$result){
                    http_response_code($this->bad_data);
                } else {
                    http_response_code($this->success);
                }
                break;
            case 'PUT':
                $parms = $this->get_request_body();
                $result = $this->put($parms);
                if (!$result){
                    http_response_code($this->bad_data);
                } else {
                    http_response_code($this->success);
                }
                break;
            case 'GET':
                $result = $this->get($_GET);
                if (is_null($result)){
                    http_response_code($this->bad_data);
                } else {
                    echo json_encode($result);
                }
                break;
            }
        } else {
            http_response_code($this->unauthorized);
            return;
        }
    }
}
?>
