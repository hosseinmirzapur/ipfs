<?php


namespace hossein\ipfs\app\Classes;





use Illuminate\Support\Facades\Http;

abstract class ApiCall
{
    protected $http;
    protected $result;

    public function __construct()
    {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkaWQ6ZXRocjoweEI2ODc4MEI3NWU1ODJmYzcyNGE2NWRFY2ZlM2EyN2VBMTdCNUE0OWQiLCJpc3MiOiJuZnQtc3RvcmFnZSIsImlhdCI6MTY1OTcxOTMwMTk4MSwibmFtZSI6ImZpbGVzdG9yYWdlIn0.yqUh3pv_2fLJ4rR6EXo9xHzbpwy6owlezU0hKFAJR-c';
        $baseUrl = 'https://api.nft.storage';
        $this->http = Http::baseUrl($baseUrl)
            ->withHeaders([
                "Authorization" => "Bearer " . $token
            ]);
    }

    protected function http()
    {
        return $this->http;
    }

    protected function getResult()
    {
        return $this->result;
    }

    /**
     * @param $cid
     * @return bool|string
     */
    protected function getFile($cid): bool|string
    {
        return base64_decode(Http::get($this->getLink($cid))->json()['file']);
    }

    /**
     * @param $cid
     * @return string
     */
    protected function getLink($cid): string
    {
        return 'https://ipfs.io/ipfs/' . $cid;
    }


}
