# zpool-php-api
PHP pulling data from ZPOOL by using api.

A single/page PHP file that pull data from ZPOOL
Helping you to monitor the status on ZPOOL

It will show you
- Confirm, Unconfirm, Paid, Unpaid and Total balance
- Miners Hashrate
- Payments details

Configure:
- Page is refresh every 10 sec, You can change the interval (in this case = 10) via line "<meta http-equiv="refresh" content="10">"
- You can correct your timezome via line "date_default_timezone_set('Asia/Bangkok');"
- Change wallet address to yours via line "$wallet = 'Xy4y9qo9V2byDCVHnzkWYmQ7gB7NQejqfb';"
- Change the over all hashrate demical via line "$demical = 2;"

Notes
- The wallet address is mine and not use anymore. so I leaved it in the code
- I'm done with ZPOOL, so this project will have no update in the future

The page will look like this
![alt text](https://github.com/eewar/zpool-php-api/blob/main/php-zpool-api.PNG?raw=true)
