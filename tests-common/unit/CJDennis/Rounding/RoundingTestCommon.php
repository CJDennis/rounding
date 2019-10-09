<?php
namespace CJDennis\Rounding;

trait RoundingTestCommon {
  protected function _before() {
  }

  protected function _after() {
  }

  // tests
  public function testShouldRoundTheFractionalPartOfANumberBelowAHalfDownToTheNextInteger() {
    $this->assertSame(1.0, Rounding::round(1.499999));
  }

  public function testShouldRoundTheFractionalPartOfANumberExactlyAHalfUpToTheNextInteger() {
    $this->assertSame(2.0, Rounding::round(1.5));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextInteger() {
    $this->assertSame(1.499, Rounding::round(1.499499, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextInteger() {
    $this->assertSame(1.5, Rounding::round(1.4995, 3));
  }
}
