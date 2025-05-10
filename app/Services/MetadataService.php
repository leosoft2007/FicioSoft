<?php

namespace App\Services;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class MetadataService
{
    public function __construct(
        protected Request $request,
        protected Agent $agent = new Agent(),
        protected array $config = []
    ) {}

    public function generateDocumentContent($content, ?string $signedContent = null): array
    {
       
        return [
            'timestamp' => now()->toIso8601ZuluString(),
            'device' => $this->getDeviceInfo(),
            'geolocation' => $this->getGeoInfo(),
            'hashes' => [
                'algorithm' => 'sha256',
                'original' => $this->generateHash($content),
                'signed' => $signedContent ? $this->generateHash($signedContent) : null
            ],
            'system' => [
                'ip' => $this->request->ip(),
                'user_agent' => $this->request->userAgent(),
                'session_id' => session()->getId()
            ]
        ];
    }

    public function generateHash($data): string
    {
        return hash('sha256', is_array($data) ? json_encode($data) : $data);
    }

    protected function getDeviceInfo(): array
    {
        return [
            'type' => $this->agent->deviceType(),
            'model' => $this->agent->device(),
            'platform' => $this->agent->platform(),
            'browser' => $this->agent->browser(),
            'is_mobile' => $this->agent->isMobile(),
            'is_tablet' => $this->agent->isTablet()
        ];
    }

    protected function getGeoInfo(): ?array
    {
        
        try {
        $location = geoip($this->request->ip());
       
       
            return [
                'lat' => $location->lat,
                'lon' => $location->lon,
                'city' => $location->city,
                'country' => $location->country
            ];
        } catch (\Exception $e) {
            return null;
        }
    }
}