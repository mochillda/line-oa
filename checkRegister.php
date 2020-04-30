<?php

function processMessage($update) {
       if (isset($update["queryResult"]["queryText"])) {
          if($update["queryResult"]["queryText"] == "ลงทะเบียน / ข้อมูลการลงทะเบียน"){
               sendMessage(array(
                   "source" => $update["responseId"],
                   "fulfillmentText"=> 'ข้อความที่จะตอบกลับแบบปกติ',
                   "fulfillmentMessages"=> [
                         array(
                           "platform"=> 'line',
                           "type"=> 'buttons',
                           "payload"=> array(
                                          "line"=> array(
                                          "type"=> "text",
//                                           "text"=> $update['originalDetectIntentRequest']['payload']['data']['source']['userId']  //"ลงทะเบียนสำเร็จ"
                                           "text"=> $update["responseId"]
                                          )
                            )
                         )
                       ],
                       "payload" => array(
                              "items"=>[
                                  array(
                                      "simpleResponse"=>
                                         array(
                                             "textToSpeech"=>"response from host"
                                              )
                                  )
                              ],
                       ),
               ));
          }
    }else{
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=> "Error",
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"Bad request"
                         )
                    )
                ],
                ),
           
        ));
        
    }
}
 
function sendMessage($parameters) {
    echo json_encode($parameters);
}
 
$update_response = file_get_contents("php://input");
$update = json_decode($update_response, true);

if (isset($update["queryResult"]["queryText"])) {
    processMessage($update);
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $update["queryResult"]["queryText"]);
    fclose($myfile);
}else{
     sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=> $update["queryResult"]["queryText"],
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"Bad request"
                         )
                    )
                ],
                ),
        ));
}

?>
