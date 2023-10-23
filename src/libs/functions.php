<?php

function dd($value = null, $die = 1)
{
    echo "<table bgcolor='black' width='100%'>
            <tr>
            <td>
            <b><font color='#32cd32'><u> Debug: </u><br><pre>";

    var_dump($value);

    echo "</pre></font></b></td></tr></table> ";

    if ($die) die;
}
