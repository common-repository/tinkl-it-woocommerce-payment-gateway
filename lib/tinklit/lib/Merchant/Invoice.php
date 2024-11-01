<?php
namespace Tinklit\Merchant;

use Tinklit\Tinklit;
use Tinklit\Merchant;
use Tinklit\NotAvailable;
use Tinklit\RecordNotFound;

class Invoice extends Merchant
{
    private $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function toHash()
    {
        return $this->invoice;
    }

    public function __get($name)
    {
        return $this->invoice[$name];
    }

    public static function find($guid, $options = array(), $authentication = array())
    {
        try {
            return self::findOrFail($guid, $options, $authentication);
        } catch (RecordNotFound $e) {
            return false;
        }
    }

    public static function findOrFail($guid, $options = array(), $authentication = array())
    {
        $invoice = Tinklit::request('/invoices/' . $guid, 'GET', array(), $authentication);

        return new self($invoice);
    }

    public static function create($params, $options = array(), $authentication = array())
    {
        try {
            return self::createOrFail($params, $options, $authentication);
        } catch (NotAvailable $e) {
            return false;
        }
    }

    public static function createOrFail($params, $options = array(), $authentication = array())
    {
        $invoice = Tinklit::request('/invoices', 'POST', $params, $authentication);

        return new self($invoice);
    }
}
