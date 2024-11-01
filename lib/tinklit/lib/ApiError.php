<?php
namespace Tinklit;

class APIError extends \Exception {}

# HTTP Status 400
class BadRequest extends APIError {}
class CredentialsMissing extends BadRequest {}
class BadEnvironment extends BadRequest {}

# HTTP Status 401
class Unauthorized extends APIError {}
class NotAuthorized extends Unauthorized {}

# HTTP Status 404
class NotFound extends APIError {}
class RecordNotFound extends NotFound {}

# HTTP Status 406
class NotAcceptable extends APIError {}
class PriceOverThreshold extends NotAcceptable {}
class PriceOverDayVolume extends NotAcceptable {}
class PriceOverMonthVolume extends NotAcceptable {}
class OutdatedBtcRate extends NotAcceptable {}

# HTTP Status 422
class UnprocessableEntity extends APIError {}
class NotAvailable extends UnprocessableEntity {}

# HTTP Status 500
class InternalServerError extends APIError {}

# HTTP Status 503
class InternalServiceError extends APIError {}
class BitcoinSocketError extends InternalServiceError {}
class LightningSocketError extends InternalServiceError {}
