# Hello Dapr

🎩 Running PHP's Dapr SDK within Swoole & Hyperf.

```shell
composer install
```

```shell
dapr run -H 3000 -a hyperf -p 9501 -- php bin/hyperf.php start
```

```shell
curl http://localhost:3000/v1.0/invoke/hyperf/method/dapr/config
```
