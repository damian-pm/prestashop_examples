<?php
namespace PrestaShop\Module\DSComment\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM; 

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class DSComment {
/**
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 * @ORM\Column(name="id", type="integer")
 */
 private $id;
/**
 * @var string
 * @ORM\Column(type="string", length=255, nullable=false)
 */
private $title;

/**
 * @var text
 * @ORM\Column(type="text", nullable=false)
 */
private $description;

/**
 * @var int
 *
 * @ORM\Column(name="product", type="integer")
 */
private $product;

/**
 * @var int
 *
 * @ORM\Column(name="customer", type="integer")
 */
private $customer;

/**
 * @var DateTime
 * @ORM\Column(type="datetime", nullable=false)
 */
private $dateAdd;

/**
 * @var integer
 * @ORM\Column(type="integer", nullable=true)
 */
private $countLike;

/**
 * @var integer
 * @ORM\Column(type="integer", nullable=true)
 */
private $countDislike;

/**
 * @var integer
 * @ORM\Column(type="integer", nullable=true)
 */
private $rating;

public function __construct()
{
	$this->setDateAdd(new \DateTime());
	$this->setRating(0);
	$this->setCustomer(1);
	$this->setCountLike(0);
	$this->setCountDislike(0);
}
public function getTitle() {
	return $this->title;
}

public function setTitle($title) {
	$this->title = $title;
	return $this;
}

public function getDescription() {
	return $this->description;
}

public function setDescription($description) {
	$this->description = $description;
	return $this;
}

public function getProduct() {
	return $this->product;
}

public function setProduct($product) {
	$this->product = $product;
	return $this;
}


public function getCountLike() {
	return $this->countLike;
}

public function setCountLike($countLike) {
	$this->countLike = $countLike;
	return $this;
}

public function getCountDislike() {
	return $this->countDislike;
}

public function setCountDislike($countDislike) {
	$this->countDislike = $countDislike;
	return $this;
}

public function getRating() {
	return $this->rating;
}

public function setRating($rating) {
	$this->rating = $rating;
	return $this;
}


/**
 * Get the value of dateAdd
 *
 * @return  DateTime
 */ 
public function getDateAdd()
{
return $this->dateAdd;
}

/**
 * Set the value of dateAdd
 *
 * @param  DateTime  $dateAdd
 *
 * @return  self
 */ 
public function setDateAdd(DateTime $dateAdd)
{
$this->dateAdd = $dateAdd;

return $this;
}

/**
 * Get the value of customer
 *
 * @return  int
 */ 
public function getCustomer()
{
return $this->customer;
}

/**
 * Set the value of customer
 *
 * @param  int  $customer
 *
 * @return  self
 */ 
public function setCustomer(int $customer)
{
$this->customer = $customer;

return $this;
}
}