<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use function donatj\UserAgent\parse_user_agent;
class BrowserDetector {
    private array $ua;
    public function __construct(?string $uaString = null){
        $this->ua = parse_user_agent($uaString ?? ($_SERVER['HTTP_USER_AGENT'] ?? ''));    }
    public function browser(){ return $this->ua['browser'] ?? ''; }
    public function version(){ return $this->ua['version'] ?? ''; }
    public function platform(){ return $this->ua['platform'] ?? ''; }
    public function isMobile(){ return stripos($this->ua['platform'] ?? '', 'android') !== false || stripos($this->ua['browser'] ?? '', 'Mobile') !== false; }
}
