<?php
namespace CJDennis\Rounding;

class Rounding {
  public static function round($number, int $new_precision = 0, int $old_precision = null) {
    $old_precision = $old_precision ?? $new_precision;
    $rounded_to_old_precision_int = round($number * pow(10, $old_precision));
    $floored_to_new_precision_int = floor($rounded_to_old_precision_int * pow(10, $new_precision - $old_precision));
    return $floored_to_new_precision_int / pow(10, $new_precision);
  }

  public static function round_fraction_up($number, int $new_precision = 0, int $old_precision = null) {
    if ($old_precision === null) {
      $adjusted_to_precision_int = $number * pow(10, $new_precision);
      $ceiling_to_precision_int = ceil($adjusted_to_precision_int);
    }
    else {
      $adjusted_to_precision_int = round($number * pow(10, $old_precision));
      $ceiling_to_precision_int = ceil($adjusted_to_precision_int * pow(10, $new_precision - $old_precision));
    }
    return $ceiling_to_precision_int / pow(10, $new_precision);
  }
}
