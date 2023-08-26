<?php require_once('private/init.php');

$encrypted_track = Helper::get_val('d');
$upload_folder = ADMIN_DIR . "/" . UPLOADED_DIR . "/" . AUDIO_DIR . "/";

if ($encrypted_track) {
    $json_data = json_decode(Encryption::decrypt(ENCRYPTION_KEY, ENCRYPTION_IV, $encrypted_track), true);

    $track_id = $json_data["id"];
    $time = $json_data["time"];
    $error_message = null;

    if(!empty($track_id) && !empty($time)){

        if(Helper::time_difference($time)->i < DOWNLOAD_LINK_ACTIVE_TIMING){

            $track = new Track();
            $track = $track->where(["id" => $json_data["id"]])->one();

            if(!empty($track)){
                
                $path = $upload_folder;

                $link = ADMIN_AUDIO_LINK;

                $filename = $track->track_name;
                $filePath = $path . $filename;
                $len = filesize($filePath);

                $type = 'octet/stream';
                $type = 'application/mp3';


                if (file_exists($filePath) && is_readable($filePath))  {

                    session_write_close();

                    //Begin writing headers
                    header("Pragma: public");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    //Use the switch-generated Content-Type
                    header("Content-Type: ".$type);
                    //Force the download
                    $header="Content-Disposition: attachment; filename=".$filename.";";
                    header($header );
                    header("Content-Transfer-Encoding: binary");
                    header("Content-Length: ". $len);

                    readfile($filePath);


                }else $error_message = "Error 404: File Not Found: <br /><em>" . $track->track_name . "</em>";
            }else $error_message = "Error 404: File Not Found";
        }else $error_message = "Error 404: Invalid Link";
    }else $error_message = "Error 404: Invalid Link";


    if($error_message != null){
        header("HTTP/1.0 404 Not Found");
        echo "<h2>" . $error_message . "</h2>";
    }
}



?>