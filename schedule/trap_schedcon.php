<?php
function trapSchedCon($appSched, $request){

    if ($appSched->num_rows > 0) {
        while ($data = $appSched->fetch_assoc()) {
            $facility = $data['facility'];
            $appSdate = date("Y-m-d H:i:s", strtotime($data['start_datetime']));
            $appEdate = date("Y-m-d H:i:s", strtotime($data['end_datetime']));
            $reqSdate = date("Y-m-d H:i:s", strtotime($request['start_datetime']));
            $reqEdate = date("Y-m-d H:i:s", strtotime($request['end_datetime']));

                if (($request['facility'] == $facility) && (($reqSdate >= $appSdate && $reqSdate <= $appEdate) || ($reqEdate >= $appSdate && $reqEdate <= $appEdate) || ($reqSdate < $appSdate && $reqEdate > $appEdate))) {
                    return false;
                } else {
                    return true;
                }
        }
    }
    else{
        return true;
    }
}

//((($request['facility'] == $facility) && ($reqSdate >= $appSdate && $reqSdate <= $appEdate) && ($reqEdate >= $appSdate && $reqEdate <= $appEdate)) || (($request['facility'] == $facility) && ($reqSdate <= $appSdate && $reqSdate <= $appEdate) && ($reqEdate >= $appSdate && $reqEdate >= $appEdate)))
?>