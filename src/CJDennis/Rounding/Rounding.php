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
    if ($number !== 0.0) {  // both 0.0 and -0.0
      $number = ceil(static::adjust_precision($number, $new_precision, $old_precision));
    }
    return $number / pow(10, $new_precision);
  }

  public static function round_fraction_down($number, int $new_precision = 0, int $old_precision = null) {
    if ($number !== 0.0) {  // both 0.0 and -0.0
      $number = floor(static::adjust_precision($number, $new_precision, $old_precision));
    }
    return $number / pow(10, $new_precision);
  }

  public static function round_towards_zero($number, int $new_precision = 0, int $old_precision = null) {
    if ($old_precision === null) {
      $adjusted_to_precision_int = $number * pow(10, $new_precision) + 0;
      if ($number < 0) {
        $rounded_to_precision_int = ceil($adjusted_to_precision_int);
      }
      elseif ($number > 0) {
        $rounded_to_precision_int = floor($adjusted_to_precision_int);
      }
      else {
        $rounded_to_precision_int = $number * $adjusted_to_precision_int;
      }
    }
    else {
      $adjusted_to_precision_int = round($number * pow(10, $old_precision));
      if ($number < 0) {
        $rounded_to_precision_int = ceil($adjusted_to_precision_int * pow(10, $new_precision - $old_precision));
      }
      elseif ($number > 0) {
        $rounded_to_precision_int = floor($adjusted_to_precision_int * pow(10, $new_precision - $old_precision));
      }
      else {
        $rounded_to_precision_int = $number;
      }
    }
    return $rounded_to_precision_int / pow(10, $new_precision);
  }

  public static function round_away_from_zero($number, int $new_precision = 0, int $old_precision = null) {
    if ($old_precision === null) {
      $adjusted_to_precision_int = $number * pow(10, $new_precision) + 0;
      if ($number < 0) {
        $rounded_to_precision_int = floor($adjusted_to_precision_int);
      }
      elseif ($number > 0) {
        $rounded_to_precision_int = ceil($adjusted_to_precision_int);
      }
      else {
        $rounded_to_precision_int = $number * $adjusted_to_precision_int;
      }
    }
    else {
      $adjusted_to_precision_int = round($number * pow(10, $old_precision));
      if ($number < 0) {
        $rounded_to_precision_int = floor($adjusted_to_precision_int * pow(10, $new_precision - $old_precision));
      }
      elseif ($number > 0) {
        $rounded_to_precision_int = ceil($adjusted_to_precision_int * pow(10, $new_precision - $old_precision));
      }
      else {
        $rounded_to_precision_int = $number;
      }
    }
    return $rounded_to_precision_int / pow(10, $new_precision);
  }

  public static function adjust_precision($number, int $new_precision, int $old_precision = null) {
    if ($old_precision === null) {
      $old_precision = 0;
    }
    else {
      $number = round($number * pow(10, $old_precision));
    }
    return $number * pow(10, $new_precision - $old_precision);
  }
}
