<?php
namespace CJDennis\Rounding;

use SebastianBergmann\Comparator\DoubleComparator;
use SebastianBergmann\Comparator\NumericComparator;

class FloatComparator extends DoubleComparator {
  public function assertEquals($expected, $actual, $delta = null, $canonicalize = false, $ignoreCase = false) {
    if ($delta === null) {
      $delta = static::EPSILON;
    }

    NumericComparator::assertEquals($expected, $actual, $delta, $canonicalize, $ignoreCase);
  }
}
