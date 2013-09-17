<?php 
class Date {
    
    public static function torelative($date) {
        $diff = time() - strtotime($date);
    if ($diff<60)
        return "Hace " . $diff . " segundo" . self::plural($diff) ;
    $diff = round($diff/60);
    if ($diff<60)
        return "Hace " . $diff . " minuto" . self::plural($diff) ;
    $diff = round($diff/60);
    if ($diff<24)
        return "Hace " . $diff . " hora" . self::plural($diff) ;
    $diff = round($diff/24);
    if ($diff<7)
        return "Hace " . $diff . " día" . self::plural($diff) ;
    $diff = round($diff/7);
    if ($diff<4)
        return "Hace " . $diff . " semana" . plural($diff) ;
    return "el " . date("F j, Y", strtotime($date));
    }
    public static function plural($num) {
        if ($num != 1)
            return "s";
    }
}