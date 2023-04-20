# Simple Slack Error Channel

Simply forward your PHP errors to a Slack channel.

```php
// Make instance
$slackErrorHandler = new Handler('https://hooks.slack.com/services/your_webhook');

// Set the error handler
set_error_handler(function (...$args) use ($slackErrorHandler) {
    $slackErrorHandler->handle(...$args);
});

// For catching fatal errors
register_shutdown_function(function () use ($slackErrorHandler) {
    $err = error_get_last();

    if (is_null($err)) {
        return;
    }

    $slackErrorHandler->handle($err['type'], $err['message'], $err['file'], $err['line']);
});
```

## Links
* [Inspiration](https://medium.com/@richb_/simple-logging-with-php-and-slack-e5e997679c0e)
* [Setting up a webhook](https://api.slack.com/messaging/webhooks#getting_started)

## Contributors
* [Jeffrey van Rossum](https://github.com/jeffreyvr)
* [All contributors](https://github.com/jeffreyvr/tailpress/graphs/contributors)

## License

MIT. Please see the [License File](/LICENSE) for more information.
