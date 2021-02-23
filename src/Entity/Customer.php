<?php 

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ValueObject\PhoneNumber;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Embedded(class="App\Entity\ValueObject\PhoneNumber", columnPrefix = false)
     * @var PhoneNumber
     */
    private $phone;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): PhoneNumber
    {
        return $this->phone;
    }
    
    /** @ORM\PostLoad() */
    public function configurePhoneNumber()
    {
        $this->phone->configure();
    }
}
