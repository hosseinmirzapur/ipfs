<?php


namespace hossein\ipfs\app\Services;


use Exception;
use hossein\ipfs\app\Classes\ApiCall;
use JetBrains\PhpStorm\Pure;
use Throwable;
use function validator;

class StoreFileToIpfs extends ApiCall
{
    /**
     * @param $file
     * @return $this
     * @throws Throwable
     */
    public function store($file): static
    {
        throw_if(!$this->isFile($file), new Exception('Problem with the content.'));
        $data = base64_encode(file_get_contents($file));
        $this->result = $this->http()->post('/upload', [
            'file' => $data
        ])->json();
        return $this;
    }

    /**
     * @return mixed
     */
    #[Pure] public function getCid(): mixed
    {
        $result = $this->getResult();
        return $result['value']['cid'];
    }

    /**
     * @param $file
     * @return bool
     */
    protected function isFile($file): bool
    {
        return !validator([
            'file' => $file
        ], [
            'file' => ['required', 'file']
        ], [
            'file' => 'Uploading a file is required.'
        ])->fails();
    }
}
