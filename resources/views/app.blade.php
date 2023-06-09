<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Zillow Clone by Minh Hoang Tran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body class="bg-white dark:bg-slate-900 text-gray-800 dark:text-gray-300 !mb-0 ">
    @inertia
  </body>
</html>