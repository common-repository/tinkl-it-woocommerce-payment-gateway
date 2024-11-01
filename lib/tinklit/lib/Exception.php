<?php
namespace Tinklit;

class Exception
{
    public static function formatError($error)
    {
        $reason= '';
        $message = '';

        if (isset($error['reason']))
            $reason = $error['reason'];

        if (isset($error['error']))
            $message = $error['error'];
        
        if (isset($error['errors']))
            $message = $error['errors'][0];
        
        if (isset($error['message']))
            $message = $error['message'];
        
        return $reason . ' - ' . $message;
    }

    public static function throwException($http_status, $error)
    {
        $reason = $error['errors'][0];

        switch ($http_status) {
            case 400:
                switch ($reason) {
                    default: throw new BadRequest(self::formatError($error));
                }
            case 401:
                switch ($reason) {
                    case 'not_authorized': throw new NotAuthorized(self::formatError($error));
                    default: throw new Unauthorized(self::formatError($error));
                }
            case 404:
                switch ($reason) {
                    case 'record_not_fount': throw new RecordNotFound(self::formatError($error));
                    default: throw new NotFound(self::formatError($error));
                }
	        case 406:
                switch ($reason) {
                    case 'price_over_threshold': throw new PriceOverThreshold(self::formatError($error));
                    case 'price_over_day_volume': throw new PriceOverDayVolume(self::formatError($error));
                    case 'price_over_month_volume': throw new PriceOverDayVolume(self::formatError($error));
                    case 'not_authorized': throw new NotAuthorized(self::formatError($error));
                    default: throw new NotAcceptable(self::formatError($error));
                }	
            case 422:
                switch ($reason) {
                    case 'not_available': throw new NotAvailable(self::formatError($error));
                    default: throw new UnprocessableEntity(self::formatError($error));
                }
            case 500:
                switch ($reason) {
                    default: throw new InternalServerError(self::formatError($error));
                }
            case 503:
                switch ($reason) {
                    case 'bitcoin_socket_error': throw new BitcoinSocketError(self::formatError($error));
                    case 'lightning_socket_error': throw new LightningSocketError(self::formatError($error));
                    default: throw new InternalServiceError(self::formatError($error));
                }
            default: throw new APIError(self::formatError($error));
        }
    }
}
