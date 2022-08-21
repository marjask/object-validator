# Object Validator
## Usage example
Query class:
```php
class UserQuery
{
    protected string $username;
    protected bool $activated;
    protected ?DateTime $registerAt;

    public  function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public  function setActivated(bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }

    public  function setRegisterAt(DateTime $registerAt): self
    {
        $this->registerAt = $registerAt;

        return $this;
    }
}
```
Validator:

```php
use Marjask\ObjectValidator\AbstractValidator;
use Marjask\ObjectValidator\Constraints\AlsoRequired;
use Marjask\ObjectValidator\Constraints\Length;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\Constraints\Option\OptionLength;
use Marjask\ObjectValidator\Constraints\Option\OptionType;
use Marjask\ObjectValidator\Constraints\Type;
use Marjask\ObjectValidator\Constraints\TypeOrNull;

final class UserQueryValidator extends AbstractValidator
{
    public function loadConstraints(): void
    {
        $this->addConstraint(
            'username',
            new Type(
                new OptionType('string')
            ),
            new Length(
                new OptionLength(
                    min: 3,
                    max: 16
                )
            )
        )
        ->addConstraint(
            'activated',
            new Type(
                new OptionType('bool')
            ),
            new AlsoRequired(
                new OptionAlsoRequired(['username'])
            )
        )
        ->addConstraint(
            'registerAt',
            new TypeOrNull(
                new OptionType(DateTime::class)
            )
        );
    }
}
```
Usage:
```php
$query = (new UserQuery())
    ->setActivated(true)
    ->setUsername('Mariusz')
    ->setRegisterAt(
        new DateTime('2022-08-15')
    );

// return true/false
var_dump(UserQueryValidator::create()->isValid($query));

// return \Marjask\ObjectValidator\ConstraintViolationList
var_dump(UserQueryValidator::create()->getViolations($query));

// throw exception \Marjask\ObjectValidator\Exception\InvalidValidationException
UserQueryValidator::create()->throwIfInvalid($query);
```
