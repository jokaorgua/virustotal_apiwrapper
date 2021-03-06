<?php
namespace VirusTotal;

class File extends ApiBase
{
    /**
     * @see https://www.virustotal.com/en/documentation/public-api/#scanning-files
     * @param string $file absolute file path
     */
    public function scan($file)
    {
        var_dump($file);
        $data = $this->_client->post(self::API_ENDPOINT . 'file/scan', [

            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($file,'r'),
                    'filename' => $file
                ],
                [
                    'name' => 'apikey',
                    'contents' => $this->_apiKey
                ]
            ]
        ]);
        return json_decode($data->getBody()->getContents(), true);
    }

    /**
     * @see https://www.virustotal.com/en/documentation/public-api/#rescanning-files
     * @param string $resource resource id that you retrieve from scan()
     */
    public function rescan($resource)
    {
        $data = $this->makePostRequest('file/rescan', array(
            'resource' => $resource,
            'apikey' => $this->_apiKey,
        ));
        return json_decode($data->getBody()->getContents(), true);
    }

    /**
     * @see https://www.virustotal.com/en/documentation/public-api/#rescanning-files
     * @param string $resource resource id that you retrieve from scan()/rescan()
     */
    public function getReport($resource)
    {
        $data = $this->makePostRequest('file/report', array(
            'resource' => $resource,
            'apikey' => $this->_apiKey,
        ));
        return json_decode($data->getBody()->getContents(), true);
    }
}
