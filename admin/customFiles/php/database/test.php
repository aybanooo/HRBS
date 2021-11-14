<?php
require_once("../directories/directories.php");
require_once(__F_OUTPUT_HANDLER__);



$output->setSuccessful(true);
$output->setSuccessful("2");

$output->setFailed("3");
$output->setFailed(4, "sadwe");

$output->setSuccessful();

echo '<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Testing area</title>
            <style>

                iframe {
                    width: 100%;
                    height: 500x;
                    background-color: #e1e1e1;
                    border: 1px solid gray;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <iframe id="result">
                    
            </iframe>
        </body>
        <script src="renderjson.js"></script>
        <script>
                
            let data = JSON.parse(\''.$output->getOutput(true).'\');
            renderjson.set_show_to_level(2);
            //native javascript
            renderjson.set_icons(\'►\', \'▼\');

            iframeStyle = `<style>
            .renderjson a              { text-decoration: none; }
            .renderjson .disclosure    { color: gray;
                                        font-size: 100%;
                                        margin-right: 5px;}
            .renderjson .syntax        { color: grey; }
            .renderjson .string        { color: green; }
            .renderjson .number        { color: cyan; }
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

echo "sad";

//echo $output->getOutputAsPreNode();