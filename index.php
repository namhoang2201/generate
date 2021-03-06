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
    <link rel="stylesheet" type="text/css" href="./css/index.css"/>
</head>
<body>
<?php
$swcontent = "
        'use strict';
        self.addEventListener(
            'install', function (event) {
                event.waitUntil(
                    self.skipWaiting()
                );
            }
        );
        self.addEventListener(
            'fetch', function (event) {
                if (event.request.method !== 'POST' &&
                    event.request.url.toString() &&
                    event.request.url.toString().indexOf('/checkout/') === -1 &&
                    event.request.url.toString().indexOf('/cart/') === -1 &&
                    event.request.url.toString().indexOf('/key/') === -1) {
                    if(!self.navigator.onLine){
                        event.respondWith(
                            caches.match(event.request)
                                .then(
                                    function (response) {
                                        if (response) {
                                            return response;
                                        }
                                        var fetchRequest = event.request.clone();
                                        return fetch(fetchRequest).then(
                                            function (response) {
                                                if (!response || response.status !== 200 || response.type !== 'basic') {
                                                    return response;
                                                }
                                                var responseToCache = response.clone();
                                                caches.open('simipwa-cache')
                                                    .then(
                                                        function (cache) {
                                                            cache.put(event.request, responseToCache);
                                                        }
                                                    );
                                                return response;
                                            }
                                        );
                                    }
                                )
                        );
                    }
                }
            }
        );
        self.addEventListener(
            'push', function (event) {
                var apiPath = './simipwa/index/message?endpoint=';
                event.waitUntil(
                    registration.pushManager.getSubscription()
                        .then(
                            function (subscription) {
                                if (!subscription || !subscription.endpoint) {
                                    throw new Error();
                                }
                                apiPath = apiPath + encodeURI(subscription.endpoint);
                                return fetch(apiPath)
                                    .then(
                                        function (response) {
                                            if (response.status !== 200){
                                                throw new Error();
                                            }
                                            return response.json();
                                        }
                                    )
                                    .then(
                                        function (data) {
                                            if (data.status == 0) {
                                                console.error('The API returned an error.', data.error.message);
                                                throw new Error();
                                            }
                                            //console.log(data);
                                            var options = {};
                                            var title = '';
                                            var icon = data.notification.logo_icon;
                                            if (data.notification.notice_title){
                                                title = data.notification.notice_title;
                                                var message = data.notification.notice_content;
                                                var url = '/';
                                                if (data.notification.notice_url) {
                                                    url = data.notification.notice_url;
                                                }
                                                if (data.notification.image_url){
                                                    options['image'] = data.notification.image_url;
                                                }
                                                var data = {
                                                    url: url
                                                };
                                                options = {
                                                    body : message,
                                                    icon: icon,
                                                    data: data
                                                };
                                            } else {
                                                title = 'New Notification';
                                                options = {
                                                    icon : icon,
                                                    data: {
                                                        url: '/'
                                                    }
                                                };
                                            }
                                            return self.registration.showNotification(title, options);
                                        }
                                    )
                                    .catch(
                                        function (err) {
                                            console.log(err);
                                            return self.registration.showNotification(
                                                'New Notification', {
                                                    icon: icon,
                                                    data: {
                                                        url: '/'
                                                    }
                                                }
                                            );
                                        }
                                    );
                            }
                        )
                );
            }
        );
        self.addEventListener(
            'notificationclick', function (event) {
                event.notification.close();
                var url = event.notification.data.url;
                event.waitUntil(
                    clients.matchAll(
                        {
                            type: 'window'
                        }
                    )
                        .then(
                            function (windowClients) {
                                for (var i = 0; i < windowClients.length; i++) {
                                    var client = windowClients[i];
                                    if (client.url === url && 'focus' in client) {
                                        return client.focus();
                                    }
                                }
                                if (clients.openWindow) {
                                    return clients.openWindow(url);
                                }
                            }
                        )
                );
            }
        );
        ";
$fileToSave = $_SERVER['DOCUMENT_ROOT'].'/generate/sw.js';
if (!file_exists($fileToSave)) {
    chmod($_SERVER['DOCUMENT_ROOT'].'/generate/', 0777);
    file_put_contents($fileToSave, $swcontent);
    chmod($fileToSave, 0777);
}
?>
<div id="root">

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12">
                <div class="wrap">
                    <div class="logo">
                        <a href="./index.php" target="_self"><img class="img-responsive"
                                                                  src="./img/icon-logo.png"
                                                                  alt="simicart-logo"></a>
                    </div>
                    <div class="title">
                        Generate manifest and service worker.
                    </div>
                </div>
                <div class="selection">
                    <div class="manifest">
                        <a href="./manifest.php">Generate manifest.json</a>
                    </div>
                    <div class="service-worker">
                        <a href="./downoad.php" target="_self">Generate sw.js</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script defer type="text/javascript" src="./js/jquery.min.js"></script>
<script defer type="text/javascript" src="./js/bootstrap.min.js"></script>
<script defer type="text/javascript" src="./js/index.js"></script>
</body>
</html>