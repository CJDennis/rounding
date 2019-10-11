<?php
namespace CJDennis\Rounding;

trait RoundingTestCommon {
  protected function _before() {
  }

  protected function _after() {
  }

  // tests
  public function testShouldRoundTheFractionalPartOfANumberBelowAHalfDownToTheNextInteger() {
    $expected = 1.0;
    $actual = Rounding::round(1.499999);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberExactlyAHalfUpToTheNextInteger() {
    $expected = 2.0;
    $actual = Rounding::round(1.5);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextInteger() {
    $expected = 1.499;
    $actual = Rounding::round(1.499499, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextInteger() {
    $expected = 1.5;
    $actual = Rounding::round(1.4995, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesBelowAHalfDownToTheNextIntegerConsideringFourDecimalPlaces() {
    $expected = 1.499;
    $actual = Rounding::round(1.499499, 3, 4);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberAfterThreeDecimalPlacesExactlyAHalfUpToTheNextIntegerConsideringFourDecimalPlaces() {
    $expected = 1.499;
    $actual = Rounding::round(1.4995, 3, 4);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerUpToTheNextInteger() {
    $expected = 1.0;
    $actual = Rounding::round_fraction_up(1.000000);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberUpToTheNextInteger() {
    $expected = 2.0;
    $actual = Rounding::round_fraction_up(1.000001);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerUpToThreeDecimalPlaces() {
    $expected = 1.0;
    $actual = Rounding::round_fraction_up(1.000000, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberUpToThreeDecimalPlaces() {
    $expected = 1.001;
    $actual = Rounding::round_fraction_up(1.000001, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerUpToTheNextIntegerConsideringThreeDecimalPlaces() {
    $expected = 1.0;
    $actual = Rounding::round_fraction_up(1.000499, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberUpToTheNextIntegerConsideringThreeDecimalPlaces() {
    $expected = 2.0;
    $actual = Rounding::round_fraction_up(1.000500, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerDownToTheNextInteger() {
    $expected = 2.0;
    $actual = Rounding::round_fraction_down(2.000000);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberDownToTheNextInteger() {
    $expected = 1.0;
    $actual = Rounding::round_fraction_down(1.999999);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerDownToThreeDecimalPlaces() {
    $expected = 2.0;
    $actual = Rounding::round_fraction_down(2.000000, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberDownToThreeDecimalPlaces() {
    $expected = 1.999;
    $actual = Rounding::round_fraction_down(1.999999, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerDownToTheNextIntegerConsideringThreeDecimalPlaces() {
    $expected = 2.0;
    $actual = Rounding::round_fraction_down(1.999500, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberDownToTheNextIntegerConsideringThreeDecimalPlaces() {
    $expected = 1.0;
    $actual = Rounding::round_fraction_down(1.999499, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerTowardsZero() {
    $expected = 2.0;
    $actual = Rounding::round_towards_zero(2.000000);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerTowardsZero() {
    $expected = 1.0;
    $actual = Rounding::round_towards_zero(1.999999);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerTowardsZero() {
    $expected = -2.0;
    $actual = Rounding::round_towards_zero(-2.000000);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerTowardsZero() {
    $expected = -1.0;
    $actual = Rounding::round_towards_zero(-1.999999);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerToThreeDecimalPlacesTowardsZero() {
    $expected = 2.0;
    $actual = Rounding::round_towards_zero(2.000000, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberToThreeDecimalPlacesTowardsZero() {
    $expected = 1.999;
    $actual = Rounding::round_towards_zero(1.999999, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundANegativeIntegerToThreeDecimalPlacesTowardsZero() {
    $expected = -2.0;
    $actual = Rounding::round_towards_zero(-2.000000, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToThreeDecimalPlacesTowardsZero() {
    $expected = -1.999;
    $actual = Rounding::round_towards_zero(-1.999999, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $expected = 2.0;
    $actual = Rounding::round_towards_zero(1.999500, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $expected = 1.0;
    $actual = Rounding::round_towards_zero(1.999499, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $expected = -2.0;
    $actual = Rounding::round_towards_zero(-1.999500, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerTowardsZeroConsideringThreeDecimalPlaces() {
    $expected = -1.0;
    $actual = Rounding::round_towards_zero(-1.999499, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundNegativeZeroTowardsZeroToNegativeZero() {
    $expected = -0.0;
    $actual = Rounding::round_towards_zero(-0.0);
    $this->assertSame($expected, $actual);
    $this->assertSame((string)$expected, (string)$actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundNegativeZeroTowardsZeroToNegativeZeroConsideringThreeDecimalPlaces() {
    $expected = -0.0;
    $actual = Rounding::round_towards_zero(-0.0, 0, 3);
    $this->assertSame($expected, $actual);
    $this->assertSame((string)$expected, (string)$actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundAnIntegerToTheNextIntegerAwayFromZero() {
    $expected = 1.0;
    $actual = Rounding::round_away_from_zero(1.000000);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANumberToTheNextIntegerAwayFromZero() {
    $expected = 2.0;
    $actual = Rounding::round_away_from_zero(1.000001);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldNotRoundANegativeIntegerToTheNextIntegerAwayFromZero() {
    $expected = -1.0;
    $actual = Rounding::round_away_from_zero(-1.000000);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }

  public function testShouldRoundTheFractionalPartOfANegativeNumberToTheNextIntegerAwayFromZero() {
    $expected = -2.0;
    $actual = Rounding::round_away_from_zero(-1.000001);
    $this->assertSame($expected, $actual);
    $this->assertTrue($expected === $actual);
  }
}
