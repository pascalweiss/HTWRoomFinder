<?php
/**
 * Created by PhpStorm.
 * User: pascal
 * Date: 10.06.15
 * Time: 16:44
 */

function echoTableHead() {
    echo '<thead>
        <tr>
            <th>Raum</th>
            <th>Verfügbar</th>
        </tr>
        </thead>';
}

function echoTableRow($room, $time) {
    echo '<tr>
            <td>'.$room.'</td>
            <td>
                <span class="badge"></span>
                '. $time .'
            </td>
        </tr>';
}

function addTableData($data) {
    echo '<tbody>';
    if (empty ($data)) {
        echoTableRow('', 'Kein verfügbarer Raum');
    }
    else {
        foreach ($data as $key => $value) {
            if (!$value) {
                $available = 'den restlichen Tag';
            } else {
                $available = 'bis ' . date('H:i', $value);
            }
            echoTableRow($key, $available);
        }
    }
    echo '</tbody>';
}

echoTableHead();
addTableData($data);
