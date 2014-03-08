<?php
class Curl_lib 
{

    private $resource = NULL;       // libcurb init() resource
    private $config   = array();    // Construction config
    public $header    = array();    // Response Header
    public $body      = array();    // Response Body

    /**
     * Factory Method
     */
    public static function factory($data = array())
    {
        return new self($data);
    }

    /**
     * Constructor
     */
    public function __construct($data = array())
    {
        $config = array(
            CURLOPT_HEADER => false
        );

        // Apply any passed configuration
        $data += $config;
        $this->config = $data;

        $this->resource = curl_init();

        // Apply configuration settings
        foreach ($this->config as $key => $value) 
        {
            $this->set_opt($key, $value);
        }
    }


    /**
     * Set option
     *
     * @param String Curl option to set
     * @param String Value for option
     * @chainable
     */
    public function set_opt($key, $value)
    {
        curl_setopt($this->resource, $key, $value);

        return $this;
    }


    /**
     * Execute the curl request and return the response
     *
     * @return String Returned output from the requested resource
     * @throws Kohana_User_Exception
     */
    public function exec()
    {
        $ret = curl_exec($this->resource);

        //Wrap the error reporting in an exception
        if ($ret === false)
        {
            kohana::log('error', curl_error($this->resource));

            throw new Exception(curl_error($this->resource));
        }
        else
        {
            return $ret;
        }

    }

    /**
     * Get Error
     * Returns any current error for the curl request
     *
     * @return string The error
     */
    public function get_error()
    {
        return curl_error($this->resource);
    }

    /**
    * Destructor
    */
    function __destruct()
    {
        curl_close($this->resource);
    }


    /**
     * Get
     * Execute an HTTP GET request using curl
     *
     * @param String url to request
     * @param Array additional headers to send in the request
     * @param Bool flag to return only the headers
     * @param Array Additional curl options to instantiate curl with
     * @return  Array       array of 'header' and 'body'
     */
    public static function get($url, 
                               Array $headers = array(), 
                               $headers_only = FALSE, 
                               Array $curl_options = array())
    {
        $ch = self::factory($curl_options);

        $ch->set_opt(CURLOPT_URL, $url)
           ->set_opt(CURLOPT_RETURNTRANSFER, TRUE)
           ->set_opt(CURLOPT_NOBODY, $headers_only)
           ->set_opt(CURLOPT_HTTPHEADER, array("Expect:"))
           ->set_opt(CURLOPT_HEADERFUNCTION, array($ch, 'read_header'))
           ->set_opt(CURLOPT_WRITEFUNCTION, array($ch, 'read_body'));

        //Set any additional headers
        if(!empty($headers)) $ch->set_opt(CURLOPT_HTTPHEADER, $headers);

        $ch->exec();

        return array(
            'header' => $ch->header,
            'body'   => $ch->body
        );
    }


    /**
     * Post
     * Execute an HTTP POST request, posting the past parameters
     *
     * @param   String      url to request
     * @param   Array       past data to post to $url
     * @param   Array       additional headers to send in the request
     * @param   Bool        flag to return only the headers
     * @param   Array       Additional curl options to instantiate curl with
     * @return  Array       array of 'header' and 'body'
     */
    public static function post($url, 
                                Array $data = array(), 
                                Array $headers = array(), 
                                $headers_only = FALSE, 
                                Array $curl_options = array())
    {
        $ch = self::factory($curl_options);

        $ch->set_opt(CURLOPT_URL, $url)
           ->set_opt(CURLOPT_NOBODY, $headers_only)
           ->set_opt(CURLOPT_RETURNTRANSFER, TRUE)
           ->set_opt(CURLOPT_POST, TRUE)
           ->set_opt(CURLOPT_POSTFIELDS, $data)
           ->set_opt(CURLOPT_HTTPHEADER, array("Expect:"))
           ->set_opt(CURLOPT_HEADERFUNCTION, array($ch, 'read_header'))
           ->set_opt(CURLOPT_WRITEFUNCTION, array($ch, 'read_body'));

        //Set any additional headers
        if(!empty($headers)) $ch->set_opt(CURLOPT_HTTPHEADER, $headers);

        $ch->exec();

        return array(
            'header' => $ch->header,
            'body'   => $ch->body
        );
    }

    /**
     * Read Header
     * A private method to be used by libcurl when reading header.
     *
     * @param   String      Curl Binded Resource
     * @param   String      Header String
     * @return  Integer     Header String Length
     */
    private function read_header($ch, $string)
    {
        $length = strlen($string);

        // Trim Header String
        $string = trim($string);

        // If not empty, push into header array
        if (!empty($string))
        {
            array_push($this->header, $string);
        }

        return $length;
    }

    /**
     * Read Body
     * A private method to be used by libcurl when reading body content.
     *
     * @param   String      Curl Binded Resource
     * @param   String      Body String
     * @return  Integer     Body String Length
     */
    private function read_body($ch, $string)
    {
        $length = strlen($string);

        // If not empty, push into body array
        if (!empty($string))
        {
            array_push($this->body, $string);
        }

        return $length;
    }

}
?>