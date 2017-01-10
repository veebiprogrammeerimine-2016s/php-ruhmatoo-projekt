<?php
trait Math {
    public function Math() {}

    public static function Multiply($x, $y) {
        if(Math::_higherThan([$x, $y])):
            return ($x * $y);
        endif;
    }

    public static function SeparateWith($What, $With) {
        if(Math::_higherThan([$What, $With])):
            return ($What / $With);
        endif;
    }

    

    private static function _higherThan($Variable) {
        $IsHigher = 0;
        if(is_array($Variable) && count($Variable) > 0):
            while(list($VariableKey, $VariableValue) = each($Variable)):
                if($VariableValue > 0):
                    $IsHigher++;
                endif;
            endwhile;

            return ($IsHigher == count($Variable)) ? true : false;
        else:
            return ($Variable > 0) ? true : false;
        endif;
    }
}
?>