<?php
declare(strict_types=1);
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Cart\Cart\Struct;

use Ramsey\Uuid\Uuid;
use Shopware\Cart\Error\ErrorCollection;
use Shopware\Cart\LineItem\LineItemCollection;
use Shopware\Framework\Struct\Struct;

class CartContainer extends Struct
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var LineItemCollection
     */
    protected $lineItems;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var ErrorCollection
     */
    protected $errors;

    public function __construct(string $name, string $token, LineItemCollection $lineItems, ErrorCollection $errors)
    {
        $this->name = $name;
        $this->token = $token;
        $this->lineItems = $lineItems;
        $this->errors = $errors;
    }

    public static function createNew(string $name): CartContainer
    {
        return new self($name, Uuid::uuid4()->toString(), new LineItemCollection(), new ErrorCollection());
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getLineItems(): LineItemCollection
    {
        return $this->lineItems;
    }

    public function getErrors(): ErrorCollection
    {
        return $this->errors;
    }

    public function clearErrors(): ErrorCollection
    {
        $errors = clone $this->errors;
        $this->errors->clear();

        return $errors;
    }
}