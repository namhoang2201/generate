<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simicart Generate</title>
    <link rel="icon" type="image/png" href="./img/icon-logo.png">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap/bootstrap.min.css.map"/>
    <link rel="stylesheet" type="text/css" href="./css/manifest.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
</head>
<body>

<div id="root">

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12">
                <div class="wrap">
                    <div class="logo">
                        <a href="./index.php"><img class="img-responsive"
                                                   src="./img/icon-logo.png"
                                                   alt="simicart-logo"></a>
                    </div>
                    <div class="title">
                        Generate manifest.json
                    </div>
                </div>
                <div class="selection">
                    <div class="myform">
                        <form id="form">
                            <div class="container">
                                <div class="row">
                                    <div class="input-field col-md-4">
                                        <label for="appname">App Name</label>
                                        <input type="text" name="name" id="appname"/>
                                    </div>
                                    <div class="input-field col-md-4">
                                        <label for="shortname">Short Name</label>
                                        <input type="text" name="short_name" id="shortname"/>
                                    </div>
                                    <div class="input-field col-md-4">
                                        <label for="themecolor">Theme Color</label>
                                        <input class="jscolor color" value="48d1cc" name="theme_color" id="themecolor"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col-md-4">
                                        <label for="display">Display</label>
                                        <input type="text" name="display" id="display" value="standalone" readonly/>
                                    </div>
                                    <div class="input-field col-md-4">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" id="description"/>
                                    </div>
                                    <div class="input-field col-md-4">
                                        <label for="bgcolor">Background Color</label>
                                        <input class="jscolor color" value="48d1cc" name="background_color"
                                               id="bgcolor"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col-md-4">
                                        <label for="scope">Application scope</label>
                                        <input type="text" name="scope" id="scope" value="/"/>
                                    </div>
                                    <div class="input-field col-md-4">
                                        <label for="starturl">Start URL</label>
                                        <input type="text" name="start_url" id="starturl" value="/"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mainform">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <pre><code id="output" class="json"></code></pre>
                                </div>
                                <div class="col-md-4" id="special-col">
                                    <h5>Generate Icons</h5>
                                    <p>Please upload a <code>512x512</code> image for the icon and we'll generate
                                        the remaining sizes.</p>
                                    <form id="upload" class="col s12 row"
                                          action="https://app-manifest.appspot.com/upload" method="post"
                                          enctype="multipart/form-data">
                                        <input type="hidden" id="manifest" name="manifest" hidden>

                                        <div class="file-field input-field col s12">
                                            <div class="btn upload">
                                                <span><i class="icon-cloud-upload"></i></span>
                                                <input type="file" name="icon" class="input-above" />
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input name="icon" class="file-path validate" type="text" />
                                            </div>
                                        </div>

                                        <p class="center col s12">
                                            <button class="btn waves-effect waves-light green" type="submit"
                                                    name="action">Generate
                                            </button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/languages/go.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script defer type="text/javascript" src="./js/jquery.min.js"></script>
<script defer type="text/javascript" src="./js/bootstrap.min.js"></script>
<script defer type="text/javascript" src="./js/jscolor.js"></script>
<script defer type="text/javascript" src="./js/index.js"></script>
</body>
</html>