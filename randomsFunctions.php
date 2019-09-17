<?php
function sousDomaine(array $parts, $sep = "(|)")
{
    $final = "";
    foreach ($parts as $value) {
        if ($value == "nope") {
            // do nothing
        } else {
            if ($final != "") {
                $final .= $sep;
                $final .= $value;
            } else {
                $final .= $value;
            }
        }
    }
    return $final;
}