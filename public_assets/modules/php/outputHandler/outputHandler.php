<?php
class outputHandler {
    public $output = array(
        "isSuccessful" => null,
        "message" => null,
        "data" => null,
        "error" => array(
            "code" => null,
            "desc" => null,
        )
    );

    function setSuccessful($message = null) {
        $this->output["isSuccessful"] = true;
        if ($message)
            $this->output["message"] .= $message;
    }

    function setFailed($message = null, $errorDesc = null, $errorCode = null) {
        $this->output["isSuccessful"] = false;
        if ($message)
            $this->output["message"] .= $message;
        $this->output["error"]["code"] = $errorCode;
        if ($errorDesc)
            $this->output["error"]["desc"] .=  $errorDesc;
    }

    function getOutput($encode = false) {
        return $encode ?  json_encode($this->output) :$this->output;
    }

    function getOutputAsPreNode() {
        echo "<pre>".$this->getOutput(true)."</pre>";
    }

    function getOutputAsHTML() {
        return '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Testing area</title>
                    <base href="http://localhost/admin/customFiles/php/database/">
                    <style>

                        iframe {
                            width: 100%;
                            height: 250px;
                            background-color: #d1d1d1;
                            border: 1px solid gray;
                            border-radius: 5px;
                            resize: vertical;
                            overflow: auto;
                        }
                    </style>
                </head>
                <body>
                    <iframe id="result">
                            
                    </iframe>
                </body>
                <script src="renderjson.js"></script>
                <script>
                        
                    let data = JSON.parse(`'.$this->getOutput(true).'`);
                    renderjson.set_show_to_level(10);
                    //native javascript
                    renderjson.set_icons(\'►\', \'▼\');

                    iframeStyle = `<style>
                    .renderjson a              { text-decoration: none; }
                    .renderjson .disclosure    { color: gray;
                                                font-size: 100%;
                                                margin-right: 5px;}
                    .renderjson .syntax        { color: grey; }
                    .renderjson .string        { color: green; }
                    .renderjson .number        { color: blueviolet; }
                    .renderjson .boolean       { color: blue; font-weight: bold; }
                    .renderjson .key           { color: black; }
                    .renderjson .keyword       { color: red; }
                    .renderjson .object.syntax { color: black; }
                    .renderjson .array.syntax  { color: lightsalmon; }

                    /* Hide scrollbar for Chrome, Safari and Opera */
                    *::-webkit-scrollbar {
                        display: none;
                    }

                    /* Hide scrollbar for IE, Edge and Firefox */
                    * {
                        -ms-overflow-style: none;  /* IE and Edge */
                        scrollbar-width: none;  /* Firefox */
                    }
                    </style>`;

                    document.querySelector("#result").contentWindow.document.body.appendChild(renderjson(data));
                    
                    document.querySelector("#result").contentWindow.document.head.innerHTML += iframeStyle;

                </script>
            </html>';
    }

    

}

$output = new outputHandler();

function dieOut(&$output, $die = false) {
    echo $output->getOutput(true);
    if ($die)
        die();
}
?>