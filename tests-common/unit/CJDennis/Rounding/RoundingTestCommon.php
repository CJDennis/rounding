<?php
namespace CJDennis\Rounding;

trait RoundingTestCommon {
  protected function _before() {
  }

  protected function _after() {
  }

  // tests
  public function testShouldRoundTheFractionalPartOfANumberBelowAHalfDownToTheNextInteger() {
    $this->assertTrue(1.0 === Rounding::round(1.499999));
  }

  public function testShouldRoundTheFractionalPartOfANumberExactlyAHalfUpToTheNextInteger() {
    $this->assertTrue(2.0 === Rounding::round(1.5));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextInteger() {
    $this->assertTrue(1.499 === Rounding::round(1.499499, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextInteger() {
    $this->assertTrue(1.5 === Rounding::round(1.4995, 3));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextIntegerConsideringFourDecimalPlaces() {
    $this->assertTrue(1.499 === Rounding::round(1.499499, 3, 4));
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextIntegerConsideringFourDecimalPlaces() {
    $this->assertTrue(1.499 === Rounding::round(1.4995, 3, 4));
  }

  public function testShouldNotRoundAnIntegerUpToTheNextInteger() {
    $this->assertTrue(1.0 === Rounding::round_fraction_up(1.000000));
  }

  public function testShouldRoundTheFractionalPartOfANumberUpToTheNextInteger() {
    $this->assertTrue(2.0 === Rounding::round_fraction_up(1.000001));
  }
}
