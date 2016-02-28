# ExceptionListenerDemo

Demo symfony application showing how to write a custom exception listener.

To start, install composer dependencies:
```
php composer.phar install
```

run a built-in server:
```
bin/console server:run
```

and send a curl GET request to the Greeting controller:
```
curl http://localhost:8000/greet/Marek -i

```

To check an exception listener, try to greet a thief:
```
curl http://localhost:8000/greet/Thief -i

```
