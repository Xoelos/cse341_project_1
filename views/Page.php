<?php


class Page
{

    public static function render($meta, $body, $session = null) {
        include "$_SERVER[DOCUMENT_ROOT]/views/components/head.php";
        include "$_SERVER[DOCUMENT_ROOT]/views/components/navigation.php";
        include "$_SERVER[DOCUMENT_ROOT]/views/components/scripts.php";

        if(isset($navigation) && isset($scripts)) {
            $page = '<!DOCTYPE html><html lang="en">';
            $page .= self::makeHead($meta);
            $page .= '<body>';
            $page .= $navigation;
            $page .= $body;
            $page .= $scripts;
            $page .= '</body></html>';
            return $page;

        }
        return '<h1>Error!</h1>';
    }

    private static function makeHead($meta) {
        if(isset($headPre) && isset($headPost))
            return $headPre . $meta . $headPost;
        else
            return "<head>
                        <meta charset='UTF-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                        <title>Project 1</title>
                        <link rel='stylesheet' href='/public/style/style.css' />
                        <link
                                rel='stylesheet'
                                href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
                                integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T'
                                crossorigin='anonymous'
                        />
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                        <link rel='icon' href='/public/assets/favicon.png'>
                    </head>";
    }
}