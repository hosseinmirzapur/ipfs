<?php


namespace hossein\ipfs\app\Services;


use hossein\ipfs\app\Classes\ApiCall;

class RetrieveFileFromIpfs extends ApiCall
{
    /**
     * @param $cid
     * @return bool|string
     */
    public function getStoreData($cid): bool|string
    {
        return $this->getFile($cid);
    }
}
