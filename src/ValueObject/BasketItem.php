<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Exception\InvalidBasketItemException;

/**
 * Value object for basket order item
 *
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class BasketItem
{
    private readonly string $name;
    private readonly int $qty;
    private readonly int $sum;
    private readonly int $total;
    private readonly string $code;
    private ?string $icon = null;
    private ?string $unit = null;
    private ?string $barcode = null;
    private ?string $header = null;
    private ?string $footer = null;
    private ?string $uktzed = null;
    private array $tax = [];
    private array $discounts = [];

    /**
     * @throws InvalidBasketItemException
     */
    public function __construct(string $name, string $code, int $qty, int $sum)
    {
        $name = trim(strip_tags($name));
        $code = trim(strip_tags($code));

        if (empty($name)) {
            throw InvalidBasketItemException::blankName();
        }

        if (empty($code)) {
            throw InvalidBasketItemException::blankCode();
        }

        $this->name = $name;
        $this->code = $code;
        $this->qty = $qty;
        $this->sum = $sum;
        // The sum, expressed in the smallest currency units, for the entire quantity of goods. For example,
        // if you sell stools at 21 Hryvnia each and have an order for 2 stools,
        // you'd have qty=2, sum=2100, and total=4200.
        $this->total = $sum * $qty;
    }

    /**
     * Link to product image
     *
     * @throws InvalidBasketItemException
     */
    public function setIcon(string $iconUrl): self
    {
        $iconUrl = trim(strip_tags($iconUrl));

        if (empty($iconUrl)) {
            throw InvalidBasketItemException::blankIconUrl();
        }

        $iconUrl = filter_var($iconUrl, FILTER_SANITIZE_URL);

        if (!filter_var($iconUrl, FILTER_VALIDATE_URL)) {
            throw InvalidBasketItemException::invalidIconURL($iconUrl);
        }

        $this->icon = $iconUrl;

        return $this;
    }

    /**
     * Product unit of measurement name
     */
    public function setUnit(string $unit): self
    {
        $this->unit = trim(strip_tags($unit));

        return $this;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = trim(strip_tags($barcode));

        return $this;
    }

    /**
     * Prefix text for the product name might be required for fiscalization.
     */
    public function setHeader(string $header): self
    {
        $this->header = trim(strip_tags($header));

        return $this;
    }

    /**
     * Suffix text for the product might be required for fiscalization.
     */
    public function setFooter(string $footer): self
    {
        $this->footer = trim(strip_tags($footer));
        ;

        return $this;
    }

    /**
     * Array of tax rates selected on the Checkbox portal during cash register registration.
     * Currently, tax rates are not applied when using monopay PRRO.
     */
    public function addTax(int $tax): self
    {
        $this->tax[] = $tax;

        return $this;
    }

    /**
     * An array of discounts or markups for this item in the cart, which will be sent
     * to Checkbox for fiscalization if the connection to Checkbox is active.
     */
    public function addDiscount(Discount $discount): self
    {
        $this->discounts[] = $discount;

        return $this;
    }

    public function setUktzed(string $uktzed): self
    {
        $this->uktzed = trim(strip_tags($uktzed));

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'code' => $this->code,
            'qty' => $this->qty,
            'sum' => $this->sum,
            'total' => $this->total,
        ];

        if ($this->icon) {
            $data['icon'] = $this->icon;
        }

        if ($this->unit) {
            $data['unit'] = $this->unit;
        }

        if ($this->barcode) {
            $data['barcode'] = $this->barcode;
        }

        if ($this->header) {
            $data['header'] = $this->header;
        }

        if ($this->footer) {
            $data['footer'] = $this->footer;
        }

        if ($this->uktzed) {
            $data['uktzed'] = $this->uktzed;
        }

        foreach ($this->discounts as $discount) {
            $data['discounts'][] = $discount->toArray();
        }

        if (count($this->tax) > 0) {
            $data['tax'] = $this->tax;
        }

        return $data;
    }
}
