<?php


class Page
{
    public string $page;

    function __construct($meta, $body) {
        include "$_SERVER[DOCUMENT_ROOT]/views/components/navigation.php";
        include "$_SERVER[DOCUMENT_ROOT]/views/components/scripts.php";

        if(isset($navigation) && isset($scripts)) {
            $this->page = '<!DOCTYPE html>
                           <html lang="en">';
            $this->page .= $this->makeHead($meta);
            $this->page .= '<body>';
            $this->page .= $navigation;
            $this->page .= $body;
            $this->page .= $scripts;
            $this->page .= '</body>
                            </html>';
        }
    }

    function makeHead($meta) {
        include "$_SERVER[DOCUMENT_ROOT]/views/components/head.php";
        if(isset($headPre) && isset($headPost))
            return $headPre . $meta . $headPost;
        else
            return "<head>
                        <meta charset='UTF-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                        <title>Project 1</title>
                        <link rel='stylesheet' href='$_SERVER[DOCUMENT_ROOT]/public/style/style.css' />
                        <link
                                rel='stylesheet'
                                href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
                                integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T'
                                crossorigin='anonymous'
                        />
                    </head>";
    }
}