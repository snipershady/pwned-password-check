<?php

namespace PwnedPassCheck\Tests;

use InvalidArgumentException;
use PwnedPassCheck\Service\PwnedPasswordCheckerService;

/*
 * Copyright (C) 2022 Stefano Perrini <perrini.stefano@gmail.com> aka La Matrigna
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of EntityTest
 * @example ./vendor/phpunit/phpunit/phpunit --verbose tests/ServiceTest.php 
 *
 * @author Stefano Perrini <perrini.stefano@gmail.com> aka La Matrigna
 */
class ServiceTest extends AbstractTestCase {

    public function testUnsafePassword(): void {
        $password = "00000";
        $s = new PwnedPasswordCheckerService();
        $hasPowned = $s->hasPowned($password);
        $this->assertTrue($hasPowned);
    }

    public function testEmptyPassword(): void {
        $password = "";
        $this->expectException(InvalidArgumentException::class);
        $s = new PwnedPasswordCheckerService();
        $hasPowned = $s->hasPowned($password);
    }

    public function testWhitespacePassword(): void {
        $password = " ";
        $this->expectException(InvalidArgumentException::class);
        $s = new PwnedPasswordCheckerService();
        $hasPowned = $s->hasPowned($password);
    }

    public function testSecurePassword(): void {
        $password = "DsEn+pRYEhessHBjL0JA3rpXt48vSWwahd+s33Wmlcg=";
        $s = new PwnedPasswordCheckerService();
        $hasPowned = $s->hasPowned($password);
        $this->assertFalse($hasPowned);
    }

}
