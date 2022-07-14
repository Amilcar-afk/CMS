<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Error">
    <style>
        :root {
            --main-color: #626262;
            --second-color: #afafaf;
            --third-color: #979797;

            --main-color-rgb: 57,96,117;
            --second-color-rgb: 85,166,211;
            --third-color-rgb: 155,188,255;

            --background-color: #ffffff;
            --text-color: black;

        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link id="container-favicon" rel="shortcut icon" href="<?= (isset($favicon[0]))? $favicon[0]->getPath() :'/style/images/logo_myfolio.png'  ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/style/dist/css/main.css" />
    <script type="text/javascript" src="/style/js/utilsMenu.js"></script>
    <script type="text/javascript" src="/style/js/animations.js"></script>
    <head>
        <div class="background-container-back-office">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    <body class="body-setup">
        <main>
            <section class="container-main-content container-main-content--setup" >
                <header>
                    <figure id="back-office-logo">
                        <a href="/">
                            <img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo">
                        </a>
                    </figure>
                    <h1 class="title title--main-color">
                        <?php $http_status_codes = array(100 => "Continue", 101 => "Switching Protocols", 102 => "Processing", 200 => "OK", 201 => "Created", 202 => "Accepted", 203 => "Non-Authoritative Information", 204 => "No Content", 205 => "Reset Content", 206 => "Partial Content", 207 => "Multi-Status", 300 => "Multiple Choices", 301 => "Moved Permanently", 302 => "Found", 303 => "See Other", 304 => "Not Modified", 305 => "Use Proxy", 306 => "(Unused)", 307 => "Temporary Redirect", 308 => "Permanent Redirect", 400 => "Bad Request", 401 => "Unauthorized", 402 => "Payment Required", 403 => "Forbidden", 404 => "Not Found", 405 => "Method Not Allowed", 406 => "Not Acceptable", 407 => "Proxy Authentication Required", 408 => "Request Timeout", 409 => "Conflict", 410 => "Gone", 411 => "Length Required", 412 => "Precondition Failed", 413 => "Request Entity Too Large", 414 => "Request-URI Too Long", 415 => "Unsupported Media Type", 416 => "Requested Range Not Satisfiable", 417 => "Expectation Failed", 418 => "I'm a teapot", 419 => "Authentication Timeout", 420 => "Enhance Your Calm", 422 => "Unprocessable Entity", 423 => "Locked", 424 => "Failed Dependency", 425 => "Too Early", 426 => "Upgrade Required", 428 => "Precondition Required", 429 => "Too Many Requests", 431 => "Request Header Fields Too Large", 444 => "No Response", 449 => "Retry With", 450 => "Blocked by Windows Parental Controls", 451 => "Unavailable For Legal Reasons", 494 => "Request Header Too Large", 495 => "Cert Error", 496 => "No Cert", 497 => "HTTP to HTTPS", 499 => "Client Closed Request", 500 => "Internal Server Error", 501 => "Not Implemented", 502 => "Bad Gateway", 503 => "Service Unavailable", 504 => "Gateway Timeout", 505 => "HTTP Version Not Supported", 506 => "Variant Also Negotiates", 507 => "Insufficient Storage", 508 => "Loop Detected", 509 => "Bandwidth Limit Exceeded", 510 => "Not Extended", 511 => "Network Authentication Required", 598 => "Network read timeout error", 599 => "Network connect timeout error"); ?>
                        <?php if(isset($http_status_codes[http_response_code()])): ?>
                            <?= http_response_code(); ?>
                            <?= $http_status_codes[http_response_code()]; ?>
                        <?php else:?>
                            Error
                        <?php endif; ?>
                    </h1>
                </header>
                <section class="p-5" style="background-color: white; border-radius: 0px 0px var(--radius, 20px) var(--radius, 20px);">
                    <div class="mt-3 mb-5">
                        <p>Looks like there's a problem.</p>
                    </div>
                    <div>
                        <a class="cta-button cta-button--submit" href="/"> Home </a>
                    </div>
                </section>
            </section>
        </main>
    </body>
</html>