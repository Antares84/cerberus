<?php
    $db = mysqli_connect("localhost", "phpuser", "alm65z", "phpdb");

    function sess_open($sess_path, $sess_name) {
        return true;
    }

    function sess_close() {
        return true;
    }

    function sess_read($sess_id) {
        GLOBAL $db;

        $result = mysqli_query($db, "SELECT Data FROM sessions WHERE SessionID = '$sess_id';");
        if (!mysqli_num_rows($result)) {
            $CurrentTime = time();
            mysqli_query($db, "INSERT INTO sessions (SessionID, DateTouched) VALUES ('$sess_id', $CurrentTime);");
            return '';
        } else {
            extract(mysqli_fetch_array($result), EXTR_PREFIX_ALL, 'sess');
            mysqli_query($db, "UPDATE sessions SET DateTouched = $CurrentTime WHERE SessionID = '$sess_id';");
            return $sess_Data;
        }
    }

    function sess_write($sess_id, $data) {
        GLOBAL $db;

        $CurrentTime = time();
        mysqli_query($db, "UPDATE sessions SET Data = '$data', DateTouched = $CurrentTime WHERE SessionID = '$sess_id';");
        return true;
    }

    function sess_destroy($sess_id) {
        GLOBAL $db;
        mysqli_query($db, "DELETE FROM sessions WHERE SessionID = '$sess_id';");
        return true;
    }

    function sess_gc($sess_maxlifetime) {
        GLOBAL $db;
        $CurrentTime = time();
        mysqli_query($db, "DELETE FROM sessions WHERE DateTouched + $sess_maxlifetime < $CurrentTime;");
        return true;
    }

    session_set_save_handler("sess_open", "sess_close", "sess_read", "sess_write", "sess_destroy", "sess_gc");
    session_start();

    $_SESSION['foo'] = "bar";
    $_SESSION['baz'] = "wombat";
?>