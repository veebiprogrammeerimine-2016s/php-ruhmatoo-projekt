<?php
require_once "math.php";
class KMI {
	use Math;

    protected static $height;
    protected static $weight;

    public function KMI($weight, $height) {
        KMI::$weight = $weight;
        KMI::$height = $height;
        
        $KMI_level = KMI::_calculate(KMI::$weight, KMI::$height);
        echo "Sinu KMI on: {$KMI_level}";
    }

    private function _calculate($weight, $height) {
        $height = Math::Multiply($height, $height);
        $weight = Math::SeparateWith($weight, $height);
        
        $KmiValue = round($weight, 1);

        return $KmiValue;
    }
}
	
?>