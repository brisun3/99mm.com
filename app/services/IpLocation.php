<?php
namespace App\Services;

class IpLocation {
    private $shared = [];

    public function share($name, $value)
    {
        $this->shared[$name] = $value;
    }

    public function get($name, $default = null)
    {
        if (isset($this->shared[$name])) {
            return $this->shared[$name];
        }

        return $default;
    }

    
    
}
?>
