<?php
namespace CJDennis\Rounding;

use PHPUnit\Framework\TestCase;

/** @covers \CJDennis\Rounding\Rounding */
class RoundingTest extends TestCase {
  protected function setUp(): void {
    $this->_before();
  }

  protected function tearDown(): void {
    $this->_after();
  }

  use RoundingTestCommon;
}
