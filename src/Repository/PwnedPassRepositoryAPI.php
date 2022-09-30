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

namespace PwnedPassCheck\Repository;

/**
 * Description of PwnedPassRepositoryInterface
 *
 * @author Stefano Perrini <perrini.stefano@gmail.com> aka La Matrigna
 */
class PwnedPassRepositoryAPI implements PwnedPassRepositoryInterface {

    public function findByHash(string $hash): string {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.pwnedpasswords.com/range/'.$hash,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Cookie: __cf_bm=ygxcGi9zL_kwrBCVOVcAHFc6Lha1t6lyXHMBw8DgTqc-1664554417-0-AfhU7dvzPjxm7rrzXZYI09ineDpLa8bWqBgK4OPmSEv7s7JYhD5GN2bfTd40L2S5CrsKB8r+87ml9ehRrHo8Wk4='
                ],
    ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

}
