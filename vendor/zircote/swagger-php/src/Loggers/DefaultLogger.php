<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

 /**
 * @OA\Info(
 *     title="Your API Title",
 *     version="1.0.0",
 *     description="A description of your API",
 *     @OA\Contact(
 *         email="contact@yourdomain.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

namespace OpenApi\Loggers;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class DefaultLogger extends AbstractLogger implements LoggerInterface
{
    public function log($level, $message, array $context = []): void
    {
        if (LogLevel::DEBUG == $level) {
            return;
        }

        if ($message instanceof \Exception) {
            $message = $message->getMessage();
        }

        if (in_array($level, [LogLevel::NOTICE, LogLevel::INFO])) {
            $error_level = E_USER_NOTICE;
        } else {
            $error_level = E_USER_WARNING;
        }

        trigger_error($message, $error_level);
    }
}
