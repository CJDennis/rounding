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
}
