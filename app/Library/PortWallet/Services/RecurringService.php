<?php

namespace App\Library\PortWallet\Services;
use App\Library\PortWallet\Exceptions\InternalServiceException;
use App\Library\PortWallet\Exceptions\NotFoundException;
use App\Library\PortWallet\Exceptions\PortWalletClientException;
use App\Library\PortWallet\Exceptions\UnauthorizedException;
use App\Library\PortWallet\Invoice;
use App\Library\PortWallet\Recurring;
use App\Library\PortWallet\RecurringCancel;
use App\Library\PortWallet\Traits\ResponseTrait;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RecurringService extends AbstractService
{
    use ResponseTrait;

    /**
     * Create a new recurring
     *
     * @param array $data
     * @return Invoice
     * @throws PortWalletClientException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws InternalServiceException
     */
    public function create(array $data): Invoice
    {
        $url = '/recurring';
        $response = $this->client->request('POST', $url, [], $data);
        $content = $this->getContent($response);

        return new Invoice($content);
    }

    /**
     * Get recurring
     *
     * @param string $invoiceId
     * @return Recurring
     * @throws PortWalletClientException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws InternalServiceException
     */
    public function retrieve(string $invoiceId)
    {
        $url = '/recurring/' . 'R' . $invoiceId;
        $response = $this->client->request('GET', $url);
        $content = $this->getContent($response);

        return new Recurring($content);
    }

    /**
     * Cancel recurring
     *
     * @param string $invoiceId
     * @param array $data
     * @return RecurringCancel
     * @throws PortWalletClientException
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws InternalServiceException
     */
    public function cancel(string $invoiceId, array $data): RecurringCancel
    {
        $url = '/recurring/cancel/' . 'R' . $invoiceId;
        $response = $this->client->request('PUT', $url, $data);
        $content = $this->getContent($response);

        return new RecurringCancel($content);
    }
}
