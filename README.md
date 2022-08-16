# Object Validator
## Usage example
```php
use Marjask\ObjectValidator\Constraints\AlsoRequired;
use Marjask\ObjectValidator\Constraints\Length;
use Marjask\ObjectValidator\Constraints\Option\OptionAlsoRequired;
use Marjask\ObjectValidator\Constraints\Option\OptionLength;
use Marjask\ObjectValidator\Constraints\Option\OptionType;
use Marjask\ObjectValidator\Constraints\Type;
use Marjask\ObjectValidator\Constraints\TypeOrNull;

class UserQuery extends \Marjask\ObjectValidator\ObjectValidator
{
    protected string $username;
    protected bool $activated;
    protected ?DateTime $registerAt;
    
    protected function loadConstraints(): void
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

$query = (new UserQuery())
    ->setActivated(true)
    ->setUsername('Mariusz')
    ->setRegisterAt(
        new DateTime('2022-08-15')
    );

// return true/false
var_dump($query->isValid());

// return \Marjask\ObjectValidator\ConstraintViolationList
var_dump($query->getViolations());

// throw exception \Marjask\ObjectValidator\Exception\InvalidValidationException
$query->throwIfInvalid();
```
