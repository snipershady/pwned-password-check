<?php

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

namespace PwnedPassCheck\Service;

use PwnedPassCheck\Repository\PwnedPassRepositoryAPI;
use InvalidArgumentException;

/**
 * Description of PwnedPasswordCheckerService
 *
 * @author Stefano Perrini <perrini.stefano@gmail.com> aka La Matrigna
 */
final class PwnedPasswordCheckerService {

    /**
     * 
     * @param string $password
     * @return bool
     * @throws InvalidArgumentException
     */
    public function hasPowned(string $password): bool {
        if (empty(trim($password))) {
            throw new InvalidArgumentException("Password cannot be empty or whitespaces string");
        }
        $sha1hash = strtoupper(hash("sha1", $password, false));
        $firstFiveChars = $this->getFirstFiveHashChars($sha1hash);
        $suffix = $this->getSuffixOfHash($sha1hash);
        $repository = new PwnedPassRepositoryAPI();
        $result = $repository->findByHash($firstFiveChars);
        $resultAsArray = $this->getSearchableStructure(explode("\n", $result));
        return $this->getOccurrencies($resultAsArray, $suffix) > 0;
    }

    private function getOccurrencies(array $resultAsArray, string $suffix): int {
        return array_key_exists($suffix, $resultAsArray) ? $resultAsArray[$suffix] : 0;
    }

    private function getFirstFiveHashChars(string $hash): string {
        return substr($hash, 0, 5);
    }

    private function getSuffixOfHash(string $hash): string {
        return substr($hash, 5);
    }

    private function getSearchableStructure(array $array): array {
        $stringTrimmedArray = [];
        foreach ($array as $row) {
            $keyAndValue = explode(":", $row);
            $stringTrimmedArray[trim($keyAndValue[0])] = (int) trim($keyAndValue[1]);
        }
        return $stringTrimmedArray;
    }

}
